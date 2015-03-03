<?php

/**
 * This is the model class for table "coach".
 *
 * The followings are the available columns in table 'coach':
 * @property integer $CoachID
 * @property integer $CommandID
 * @property string $CoachName
 */
class Coach extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Coach the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'coach';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CommandID, CoachName', 'required'),
			array('CommandID', 'numerical', 'integerOnly'=>true),
			array('CoachName', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CoachID, CommandID, CoachName', 'safe', 'on'=>'search'),
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
            'Command'=> array(self::BELONGS_TO, 'Command', 'CommandID'),
		);
	}

    /**
    * SQL-параметры по умолчанию
    */
    /*public function defaultScope() {
        return array(
            //'alias'=>'coach',
            'order'=>'coach.CoachName ASC'
        );
    }*/
    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CoachID' => 'ИД тренера',
			'CoachName' => Yii::t('fullnames', 'Coach Name'),
			//'CommandID' => Yii::t('fullnames', 'CommandID'),
			//'CommandName' => Yii::t('fullnames', 'CommandName'),
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

		$criteria->compare('CoachID',$this->CoachID);
		$criteria->compare('CommandID',$this->CommandID);
		$criteria->compare('CoachName',$this->CoachName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    //СТАТ: узнать количество спортсменов
    static function getCoachCount() {
        $sqlCommand = Yii::app()->db->createCommand()
            ->select('COUNT(*)')
            ->from('coach C')
            ->leftJoin('command D', 'D.commandid = C.commandid')
            ->where('D.competitionid = :competitionid')
            ->bindParam(':competitionid', $competitionId, PDO::PARAM_INT);
        $count = $sqlCommand->queryScalar();
        return $count;
    }
    
    //ЗАПРОС: список спортсменов команды
    static public function sqlCoachList($CommandID = null) {
        $arrFields = array('C.CoachID',
                           'CoachName');
        if (!isset($CommandID) || empty($CommandID))
            $arrFields[] = 'D.CommandName';    
        $sqlCommand = Yii::app()->db->createCommand()
            ->select($arrFields)
            ->from('coach C');
        if (isset($CommandID) && !empty($CommandID)) {
            $sqlCommand->where('C.commandid = '.$CommandID);
        } else {
            $sqlCommand->leftJoin('command D', 'D.commandid = C.commandid');
            $sqlCommand->where('D.competitionid = :competitionid');
            $competitionId = Yii::app()->competitionId;
            $sqlCommand->bindParam(':competitionid', $competitionId, PDO::PARAM_INT);
        }
        return $sqlCommand;
    }
    
}