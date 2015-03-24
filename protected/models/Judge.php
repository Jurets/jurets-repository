<?php

/**
 * This is the model class for table "judge".
 *
 * The followings are the available columns in table 'judge':
 * @property integer $id
 * @property integer $userid
 * @property string $category
 * @property string $level
 * @property integer $competitionid
 * @property integer $commandid
 * @property integer $status
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Command $command
 * @property Competition $competition
 * @property User $user
 */
class Judge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Judge the static model class
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
		return 'judge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            //array('userid, category, competitionid, status, created', 'required'),
			array('category', 'required'),
            //array('userid, competitionid, commandid, status', 'numerical', 'integerOnly'=>true),
			array('userid, competitionid, status', 'numerical', 'integerOnly'=>true),
			array('category, level', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('id, userid, category, level, competitionid, status, created', 'safe', 'on'=>'search'),
			//array('id, userid, category, level, competitionid, commandid, status, created', 'safe', 'on'=>'search'),
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
			//'command' => array(self::BELONGS_TO, 'Command', 'commandid'),
			'competition' => array(self::BELONGS_TO, 'Competition', 'competitionid'),
			'user' => array(self::BELONGS_TO, 'Users', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userid' => 'Userid',
			'category' => 'Категория',
			'level' => 'Квалификация (Дан)',
			'competitionid' => 'Competitionid',
			//'commandid' => 'Commandid',
			'status' => 'Status',
			'created' => 'Created',
            
            'Lastname' => Yii::t('fullnames', 'LastName'),
            'firstname' => Yii::t('fullnames', 'FirstName'),
            'federation' => Yii::t('fullnames', 'Federation'),
            'post' => Yii::t('fullnames', 'Post'),
            'country' => Yii::t('fullnames', 'Country'),
            'city' => Yii::t('fullnames', 'City'),
            'club' => Yii::t('fullnames', 'Club'),
            'address' => Yii::t('fullnames', 'Address'),
            'phone' => Yii::t('fullnames', 'Phone'),
            'email' => Yii::t('fullnames', 'E-mail'),
            'www' => Yii::t('fullnames', 'www'),
            
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

		$criteria->compare('id',$this->id);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('competitionid',$this->competitionid);
		//$criteria->compare('commandid',$this->commandid);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}