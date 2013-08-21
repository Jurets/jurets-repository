<?php

/**
 * This is the model class for table "photopost".
 *
 * The followings are the available columns in table 'photopost':
 * @property string $post_id
 * @property string $photo_id
 * @property integer $order_nr
 */
class Photopost extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Photopost the static model class
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
		return 'photopost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_id, photo_id, order_nr', 'required'),
			array('order_nr', 'numerical', 'integerOnly'=>true),
			array('post_id, photo_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_id, photo_id, order_nr', 'safe', 'on'=>'search'),
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
            'photo' => array(self::HAS_ONE,'Photo', 'photo_id'),
            'posting' => array(self::BELONGS_TO,'Post','post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_id' => 'Post',
			'photo_id' => 'Photo',
			'order_nr' => 'Order Nr',
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

		$criteria->compare('post_id',$this->post_id,true);
		$criteria->compare('photo_id',$this->photo_id,true);
		$criteria->compare('order_nr',$this->order_nr);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}