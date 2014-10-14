<?php

/**
 * This is the model class for table "agecategory".
 *
 * The followings are the available columns in table 'agecategory':
 * @property integer $AgeID
 * @property string $AgeName
 * @property string $Gender
 * @property integer $AgeMin
 * @property integer $AgeMax
 * @property integer $YearMin
 * @property integer $YearMax
 */
class Agecategory extends CActiveRecord
{
	const TABLE_NAME = 'agecategory';
    
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Agecategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    static public function getList() {
        return 1;
    }
    

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return self::TABLE_NAME;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('AgeName, Gender', 'required'),
			array('AgeMin, AgeMax', 'numerical', 'integerOnly'=>true),
			array('AgeName', 'length', 'max'=>30),
			array('Gender', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AgeID, AgeName, Gender, AgeMin, AgeMax', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		    'relWeigths' => array(self::HAS_MANY, 'Weightcategory', 'AgeID'),
        );
	}

    /**
    * put your comment there...
    * 
    */
    public function defaultScope() {
        return array(
            //'order'=>$this->getTableAlias().'ordernum, '.$this->getTableAlias().'AgeID ASC'
            'alias'=>'age',
            'order'=>'age.ordernum, age.AgeID ASC'
        );
    }
    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'AgeID' => Yii::t('fullnames', 'ID'),
			'AgeName' => Yii::t('fullnames', 'Age Name'),
			'Gender' => Yii::t('fullnames', 'Gender'),
			'AgeMin' => Yii::t('fullnames', 'Age Min'),
			'AgeMax' => Yii::t('fullnames', 'Age Max'),
            'YearMin' => Yii::t('fullnames', 'Year Min'),
            'YearMax' => Yii::t('fullnames', 'Year Max'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('AgeID',$this->AgeID);
		$criteria->compare('AgeName',$this->AgeName,true);
		$criteria->compare('Gender',$this->Gender,true);
		$criteria->compare('AgeMin',$this->AgeMin);
		$criteria->compare('AgeMax',$this->AgeMax);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    //Jurets: получить название возрастной категории (по ID)
    public function getAgeNameYear() {
        $aname = $this->AgeName;
        $ymin = $this->YearMin;
        $ymax = $this->YearMax;
        if (!is_null($ymin) || !is_null($ymax)) {
            $aname .= ' (';
            if (!is_null($ymin))
                $aname .= $ymin;
            if (!is_null($ymax))
                $aname .= ' - '.$ymax;
            $aname .= ' р.н.)';
        }
        return $aname;
    }

    //выбрать возрастные категории (с весовыми) для соревнования
    public static function getAges() {
        //$compId = Yii::app()->competitionId; //вычислить ИД соревнования
        $compId = self::competitionIdWithAges(); //вычислить ИД соревнования
        $_cacheID = 'cacheAgeList' . $compId;
        $ages = Yii::app()->cache->get($_cacheID);   //проверить кэш
        if ($ages === false) {
            $ages = Agecategory::model()
                ->with('relWeigths')
                ->findAll('CompetitionID = :compId', array(':compId'=>$compId));
            if (empty($ages)) {  //если нет категорий по такому ИД сор-ия
                $ages = Agecategory::model()
                ->with('relWeigths')
                ->findAll('CompetitionID = :compId', array(':compId'=>0));
            }
            // и сохраняем его в кэше для дальнейшего использования:
            Yii::app()->cache->set($_cacheID, $ages, 3600 * 1);  //1 час
        }
        return $ages;
    }
    
    //вычислить ИД соревнования, по которому есть возрастные категории
    private static function competitionIdWithAges() {//DebugBreak();
        $compId = Yii::app()->competitionId;
        $cmd = Yii::app()->db->createCommand();
        //$count = $cmd->createCountCommand(self::TABLE_NAME, Yii::app()->db->createCriteria('CompetitionID = :compId', array(':compId'=>$compId)))->queryScalar();
        $count = $cmd->select('COUNT(*)')->from(self::TABLE_NAME)->where('CompetitionID = :compId')->queryScalar(array(':compId'=>$compId));
        return ($count > 0 ? $count : 0);
    }
    
    //выбрать диапазон годов рождения по соревнованию
    //(от минимального до максимального)
    public static function getYears() {
        $compId = self::competitionIdWithAges(); //вычислить ИД соревнования
        $_cacheID = 'cacheAgeYearPeriod' . $compId;
        //Yii::app()->cache->delete($_cacheID);     //удаление из кэша
        $row = Yii::app()->cache->get($_cacheID);   //проверить кэш
        if ($row === false) {
            // устанавливаем значение $value заново, т.к. оно не найдено в кэше,
            $row = Yii::app()->db->createCommand(/*'SELECT MIN(YearMin) AS YearMin, MAX(YearMax) AS YearMax FROM agecategory'*/)
                ->select('MIN(coalesce(YearMin, 1970)) AS YearMin, MAX(YearMax) AS YearMax')
                ->from(self::TABLE_NAME)
                ->where('CompetitionID = :compId')
                ->queryRow(true, array(':compId'=>$compId));
            // и сохраняем его в кэше для дальнейшего использования:
            Yii::app()->cache->set($_cacheID, $row, 3600 * 1);  //1 час
        }
        $ymin = $row['YearMin'];
        $ymax = $row['YearMax'];

        $years = array();
        for ($year = $ymax; $year >= $ymin; $year--)
            $years[$year.'-01-01'] = $year;            //ВРЕМЕННО!!!! -------- надо будет переделать
        return $years;
    }    
}