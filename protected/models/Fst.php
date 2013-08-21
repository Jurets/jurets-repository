<?php

/**
 * This is the model class for table "fst".
 *
 * The followings are the available columns in table 'fst':
 * @property integer $FstID
 * @property string $FstName
 */
class Fst extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fst the static model class
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
		return 'fst';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FstName', 'required'),
			array('FstName', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FstID, FstName', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FstID' => 'Fst',
			'FstName' => 'Fst Name',
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

		$criteria->compare('FstID',$this->FstID);
		$criteria->compare('FstName',$this->FstName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getList() {
        $_cacheID = 'cacheFst';
        $data = Yii::app()->cache->get($_cacheID);
        if ($data === false) {
            // устанавливаем значение $value заново, т.к. оно не найдено в кэше,
            // и сохраняем его в кэше для дальнейшего использования:
            $data = self::model()->findAll();
            Yii::app()->cache->set($_cacheID, $data, 28800);
        }
        
        return $data;
    }
}