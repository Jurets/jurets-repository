<?php

/**
 * This is the model class for table "title_photo".
 *
 * The followings are the available columns in table 'title_photo':
 * @property string $post_id
 * @property string $photo_id
 * @property string $filename
 * @property string $description
 * @property string $thumb_filename
 * @property string $pmime_type
 * @property string $tmime_type
 * @property string $pfilesize
 * @property string $tfilesize
 */
class TitlePhoto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TitlePhoto the static model class
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
		return 'main_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename', 'required'),
			array('post_id, photo_id, pfilesize, tfilesize', 'length', 'max'=>11),
			array('filename, description, thumb_filename, pmime_type, tmime_type', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_id, photo_id, filename, description, thumb_filename, pmime_type, tmime_type, pfilesize, tfilesize', 'safe', 'on'=>'search'),
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
		    'post' =>array(self::BELONGS_TO, 'Posting', array('post_id'=>'post_id')),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getPhotoData($id,$addPhotos=false)
    {
         $criteria=new CDbCriteria(array('condition'=>'post_id='.$id));
         if ($addPhotos) {
             
             $photo = GalleryPhoto::model()->findAll($criteria);
         }else 
         {
            $photo = TitlePhoto::model()->findAll($criteria);    
         }
         
         if (count($photo)>0)
         {
             return $photo;
         }else 
           return  null;
    }
}