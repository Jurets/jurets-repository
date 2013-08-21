<?php

/**
 * This is the model class for table "photo".
 *
 * The followings are the available columns in table 'photo':
 * @property string $photo_id
 * @property string $filename
 * @property string $description
 * @property string $thumb_filename
 * @property string $pmime_type
 * @property string $tmime_type
 * @property string $pfilesize
 * @property string $tfilesize
 * @property string $orig_name
 */
class Photo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Photo the static model class
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
		return 'photo';
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
			array('filename, description, thumb_filename, pmime_type, tmime_type, orig_name', 'length', 'max'=>255),
			array('pfilesize, tfilesize', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('photo_id, filename, description, thumb_filename, pmime_type, tmime_type, pfilesize, tfilesize, orig_name', 'safe', 'on'=>'search'),
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
			'photo_id' => 'Photo',
			'filename' => 'Filename',
			'description' => 'Description',
			'thumb_filename' => 'Thumb Filename',
			'pmime_type' => 'Pmime Type',
			'tmime_type' => 'Tmime Type',
			'pfilesize' => 'Pfilesize',
			'tfilesize' => 'Tfilesize',
			'orig_name' => 'Orig Name',
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

		$criteria->compare('photo_id',$this->photo_id,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('thumb_filename',$this->thumb_filename,true);
		$criteria->compare('pmime_type',$this->pmime_type,true);
		$criteria->compare('tmime_type',$this->tmime_type,true);
		$criteria->compare('pfilesize',$this->pfilesize,true);
		$criteria->compare('tfilesize',$this->tfilesize,true);
		$criteria->compare('orig_name',$this->orig_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function afterDelete() {
        if (file_exists($this->filename))
            unlink ($this->filename);
        if (file_exists($this->thumb_filename))
            unlink ($this->thumb_filename);
    }
}