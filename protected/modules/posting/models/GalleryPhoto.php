<?php

/**
 * This is the model class for table "gallery_photo".
 *
 * The followings are the available columns in table 'gallery_photo':
 * @property string $post_id
 * @property string $photo_id
 * @property string $filename
 * @property string $description
 * @property string $thumb_filename
 * @property string $pmime_type
 * @property string $tmime_type
 * @property string $pfilesize
 * @property string $tfilesize
 * @property integer $order_nr
 */
class GalleryPhoto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GalleryPhoto the static model class
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
		return 'gallery_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_id, filename, order_nr', 'required'),
			array('order_nr', 'numerical', 'integerOnly'=>true),
			array('post_id, photo_id, pfilesize, tfilesize', 'length', 'max'=>11),
			array('filename, description, thumb_filename, pmime_type, tmime_type', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_id, photo_id, filename, description, thumb_filename, pmime_type, tmime_type, pfilesize, tfilesize, order_nr', 'safe', 'on'=>'search'),
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
			'post_id' => 'Post',
			'photo_id' => 'Photo',
			'filename' => 'Filename',
			'description' => 'Description',
			'thumb_filename' => 'Thumb Filename',
			'pmime_type' => 'Pmime Type',
			'tmime_type' => 'Tmime Type',
			'pfilesize' => 'Pfilesize',
			'tfilesize' => 'Tfilesize',
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
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('thumb_filename',$this->thumb_filename,true);
		$criteria->compare('pmime_type',$this->pmime_type,true);
		$criteria->compare('tmime_type',$this->tmime_type,true);
		$criteria->compare('pfilesize',$this->pfilesize,true);
		$criteria->compare('tfilesize',$this->tfilesize,true);
		$criteria->compare('order_nr',$this->order_nr);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getPhotos($post_id) {
        $criteria=new CDbCriteria;
        //$criteria->compare('post_id', $post_id, true);
        $criteria->addCondition(sprintf('post_id = %d', $post_id));
        return GalleryPhoto::model()->findAll($criteria); 
      
    }
}