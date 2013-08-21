<?php

/**
 * This is the model class for table "posting".
 *
 * The followings are the available columns in table 'posting':
 * @property string $post_id
 * @property string $title
 * @property string $meta_description
 * @property string $post_type
 * @property string $date_create
 * @property string $num_comments
 * @property string $t_photo_id
 * @property string $teaser
 * @property integer $is_active
 * @property string $like_count
 * @property string $informer_title
 * @property integer $show_gallery
 */
class Posting extends CActiveRecord
{
    const PNEWS=1;
    const PBLOG=2;
    const PGALLERY=3;
    const PVIDEO=4;
    const POUTERNEWS=5;
    
    public $photoId;
    public $photoDescription;
    public $photoIds = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Posting the static model class
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
		return 'posting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
          //add new rules (Jurets)
            array('num_comments', 'default', 'value'=>0),
            array('post_type', 'default', 'value'=>Posting::PGALLERY),
            array('date_create', 'default', 'value'=>CTimestamp::formatDate('Y-m-d H:i:s')),

			array('post_type, num_comments, title, meta_description', 'required'),
			array('is_active, show_gallery', 'numerical', 'integerOnly'=>true),
			array('title, teaser, informer_title', 'length', 'max'=>255),
			array('post_type', 'length', 'max'=>1),
			array('num_comments, t_photo_id, like_count', 'length', 'max'=>11),
			array('meta_description, date_create,photoIds', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_id, title, meta_description, post_type, date_create, num_comments, t_photo_id, teaser, is_active, like_count, informer_title, show_gallery', 'safe', 'on'=>'search'),
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
            'photos' => array(self::MANY_MANY, 'Photo', 'photopost(post_id, photo_id)'),
            'photoposts' => array(self::HAS_MANY, 'Photopost', 'post_id'),             
            //'photo' =>array(self::BELONGS_TO, 'Photo', 't_photo_id'),
            'photo' =>array(self::HAS_ONE, 'TitlePhoto', array('post_id'=>'post_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_id' => Yii::t('fullnames', 'ID'),
			'title' => Yii::t('fullnames', 'Title'),
			'meta_description' => Yii::t('fullnames', 'Meta Description'),
			'post_type' => Yii::t('fullnames', 'Post Type'),
			'date_create' => Yii::t('fullnames', 'Date Create'),
			'num_comments' => Yii::t('fullnames', 'Num Comments'),
			't_photo_id' => Yii::t('fullnames', 'T Photo'),
			'teaser' => Yii::t('fullnames', 'Teaser'),
			'is_active' => Yii::t('fullnames', 'Is Active'),
			'like_count' => Yii::t('fullnames', 'Like Count'),
			'informer_title' => Yii::t('fullnames', 'Informer Title'),
			'show_gallery' => Yii::t('fullnames', 'Show Gallery'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('num_comments',$this->num_comments,true);
		$criteria->compare('t_photo_id',$this->t_photo_id,true);
		$criteria->compare('teaser',$this->teaser,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('like_count',$this->like_count,true);
		$criteria->compare('informer_title',$this->informer_title,true);
		$criteria->compare('show_gallery',$this->show_gallery);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    //saving related model (photo) after posting saving
    protected function afterSave(){
        parent::afterSave();
        $this->deletePhotos();  //delete photos from DB, wich was deleted from form
        $this->savePhotos();    //save photos
    }
    
    //set photo id's for post photos from $POST
    public function setPhotoIds($postFiles) {
        //first pass - getting id's of photo (must be 1st, becouse description may go first in POST-array)
         foreach($postFiles as $varName=>$value) {
             if (strpos($varName,'photoIds')!==false) {
                $key = str_replace('photoIds_', '', $varName);
                $this->photoIds[$key] = '';
             }
         }
         //second pass - getting descriptions (it must be only after first pass)
         foreach($postFiles as $varName=>$value) {
             if (strpos($varName,'description')!==false) {
                $key = str_replace('description_', '', $varName);
                $this->photoIds[$key] = $value;
             }
         }
    }
    
    private function getMaxOrder($post_id)
    {
        $criteria = new CDbCriteria;
        $criteria->select = new CDbExpression('MAX(order_nr) as maxorder');
        $criteria->condition = 'post_id = '.$post_id; 
        $cmd = Photopost::model()->getCommandBuilder()->createFindCommand(Photopost::model()->tableName(), $criteria);
        $max = $cmd->query()->read(); 
        
        $data = $max['maxorder'];
        if (empty($data)) {
            $data = 0;
        }
        return $data;
    }
    
    //delete photos for gallery-posting
    public function deletePhotos() 
    {
        foreach($this->photos as $id=>$photo)
            if (!isset($this->photoIds[$photo->photo_id])) {
                Photopost::model()->deleteAll('post_id = :post_id AND photo_id = :photo_id', array(':post_id'=>$this->post_id, ':photo_id'=>$photo->photo_id));
                $photo->delete();
            }
    }

    //save photos for gallery-posting
    public function savePhotos() 
    {
        if (count($this->photoIds)>0){
            if (isset($this->post_id))      //if exist postid (real post in DB)
                $orderNr = $this->getMaxOrder($this->post_id);  //max order ????
            foreach($this->photoIds as $photo_id=>$description)
            {
              $photo = Photo::model()->findByPk($photo_id);
              if ($photo)
              {
                  $photo->description = $description;
                  $success = $photo->save();
                  if (!$success && $photo->hasErrors('description'))
                    $this->addError('photoIds', $photo->getError('description').': '.$photo->orig_name);
              }
              if (isset($this->post_id)) {     //if exist postid (real post in DB)
                  $pPost= new Photopost;
                  if ($pPost->findByPk(array('post_id'=>$this->post_id,'photo_id'=>$photo_id))==null)
                  {
                    $pPost->post_id = $this->post_id;
                    $pPost->photo_id = $photo_id;
                    $pPost->order_nr = ($orderNr+=10);
                    if(!$pPost->save()) 
                        return false;  
                  }
              }
            }
        }
       return true; 
    }
    
}