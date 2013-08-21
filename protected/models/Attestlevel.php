<?php

/**
 * This is the model class for table "attestlevel".
 *
 * The followings are the available columns in table 'attestlevel':
 * @property integer $AttestLevelID
 * @property string $AttestLevel
 */
class Attestlevel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Attestlevel the static model class
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
		return 'attestlevel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('AttestLevel', 'required'),
			array('AttestLevel', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AttestLevelID, AttestLevel', 'safe', 'on'=>'search'),
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
			'AttestLevelID' => 'Attest Level',
			'AttestLevel' => 'Attest Level',
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

		$criteria->compare('AttestLevelID',$this->AttestLevelID);
		$criteria->compare('AttestLevel',$this->AttestLevel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getList() {//DebugBreak();
        $_cacheID = 'cacheAttestLevel';
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