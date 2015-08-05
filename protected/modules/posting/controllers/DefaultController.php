<?php
Yii::app()->bootstrap->register();

//подключить класс для работы с VKontakte
/////////require_once('VK.php');

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'show', 'loadphotos', 'loadimages', 'loadportrait'),
				'users'=>array('*'),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('upload','uploads','uploadportrait','delete', 'deletefile'),
                'users'=>array('@'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'getalbums', 'getphotos', 'addphoto'/*,'upload','uploads','delete', 'deletefile'*/),
				'roles'=>array('admin', 'manager'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    //показать галерею в новом окне (всплывающем)
    public function actionShow($id) {
        $this->layout = 'popup';
        $gallery = new GalleryPhoto();
        $gallery = $gallery->getPhotos($id);
        $post = Posting::model()->findByPk($id);
        //$photo = Photo::model()->findByPk($post->t_photo_id);
        $this->render('galleryview',array('gallery'=>$gallery,'post'=>$post/*,'photo'=>$photo*/));
    }
    
    
	// Creates a new model.
	// If creation is successful, the browser will be redirected to the 'view' page.
	public function actionCreate()
	{   //вызвать действие "редактирование"
		$this->actionUpdate(); 
	}

	// Updates a particular model.
	// If update is successful, the browser will be redirected to the 'view' page.
	// @param integer $id the ID of the model to be updated
	public function actionUpdate()
	{
        $id = Yii::app()->request->getParam('id'); //get param 'id' from request string
        $editMode = isset($id);   //if id was set, there is editing (nor creating)
        
        if ($editMode) {
            $model = $this->loadModel($id);
            //$choices = $model->choices;                //set poll choices (from relation) into var
            //$model->selectedSites = $model->relSites; //set selected sites for poll (from DB)
        } else {
            $model = new Posting;                         //create new poll
            //$choices = array();
            //$model->selectedSites = array();
            $model->isNewRecord = true;
        }
		
        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Posting']))
		{
			$model->attributes=$_POST['Posting'];
            if (isset($_POST['PostFiles']))
                $model->setPhotoIds($_POST['PostFiles']);
			if($model->save())
				$this->redirect(array('view','id'=>$model->post_id));
		}
		$this->render('update',array(
			'model'=>$model,
            'editMode'=>$editMode,
		));
	}

	// Deletes a particular model. If deletion is successful, the browser will be redirected to the 'admin' page.
	// @param integer $id the ID of the model to be deleted
	public function actionDelete($id)
	{   //DebugBreak();
		$success = $this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        else
            return $success;
	}

    // Lists all models.
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Posting');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Posting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Posting']))
			$model->attributes=$_GET['Posting'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Posting::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Performs the AJAX validation. @param CModel the model to be validated
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='posting-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    //загрузить фотографии / Load photos per photo_id ()
    public function actionLoadPhotos($id, $ismain) {
        //DebugBreak();
        if ($ismain)
            $photos = Photo::model()->findAllByPk($id);  //get models for main photo
        else {
            $arr = explode('&', $id);                    //list of photo id's
            $photoliststr = implode(',', $arr);          //get models for photo list
            $photos = Photo::model()->findAll('photo_id in ('.$photoliststr.')');
        }
        if ($photos) 
            $this->echoFiles($photos);
    }
    
    //Load images for POSTING model (getting model by id (postid))
    public function actionLoadImages($id, $title) {
        //DebugBreak();
        $photo = new TitlePhoto;
        $addPhoto = empty($title);
        $photos = $photo->getPhotoData($id, $addPhoto); //get photos by postid
        
        if (isset($photos)) 
            $this->echoFiles($photos);
    }
        
    //Load Portait for Sportsmen model
    public function actionLoadPortrait($id) {
        //DebugBreak();
        //$photo = new TitlePhoto;
        //$addPhoto = empty($title);
        //$photos = $photo->getPhotoData($id, $addPhoto); //get photos by postid
        
        $sportsmen = Sportsmen::model()->findByPk($id);
        if (isset($sportsmen)) {
            $photoid = $sportsmen->photoid;
            $photo = Photo::model()->findByPk($photoid);
            //$photos[] = $photo;
        }
        if (isset($photo)) 
            $this->echoFile($photo);
    }

    //private function for photo files output
    private function echoFile($photo)
    {   //DebugBreak();
        $files =  array();
        $uploadPath = Yii::app()->UploadImageDir; //Yii::app()->getBasePath().'/../uploads/'; 
        $publicPath = Yii::app()->UploadImageLoc; //Yii::app()->getBaseUrl(true).'/uploads/'; 
        //foreach ($photos as $photoData) {
        $photoData = $photo;
            $files[] =  array(
                        "name" => basename($photoData->orig_name),
                        "type" => $photoData->tmime_type,
                        "size" => $photoData->tfilesize,
                        "title" =>$photoData->description,
                        "url" => Yii::app()->getUploadImageUrl($photoData->filename), //$publicPath.basename($photoData->filename), //
                        "photo_id" =>$photoData->photo_id,
                        "thumbnail_url" => Yii::app()->getUploadImageUrl($photoData->filename), //$publicPath.basename($photoData->thumb_filename), //
                        //"delete_url" => $this->createUrl( "/posting/default/deletefile",array("id"=>$photoData->photo_id)),
                        "delete_url" => $this->createUrl( "/posting/default/deletefile",array("id"=>$photoData->photo_id)),
                        "delete_type" => "POST"
                    ); 
        //}
        echo json_encode( $files );  //return (ajax) list of photo-files
    }
        
    //private function for photo files output
    private function echoFiles($photos)
    {   //DebugBreak();
        $files =  array();
        $uploadPath = Yii::app()->UploadImageDir; //Yii::app()->getBasePath().'/../uploads/'; 
        $publicPath = Yii::app()->UploadImageLoc; //Yii::app()->getBaseUrl(true).'/uploads/'; 
        foreach ($photos as $photoData) {
            $files[] =  array(
                        "name" => basename($photoData->orig_name),
                        "type" => $photoData->tmime_type,
                        "size" => $photoData->tfilesize,
                        "title" =>$photoData->description,
                        "url" => Yii::app()->getUploadImageUrl($photoData->filename), //$publicPath.basename($photoData->filename), //
                        "photo_id" =>$photoData->photo_id,
                        "thumbnail_url" => Yii::app()->getUploadImageUrl($photoData->thumb_filename), //$publicPath.basename($photoData->thumb_filename), //
                        "delete_url" => $this->createUrl("/posting/default/deletefile",array("id"=>$photoData->photo_id)),
                        "delete_type" => "POST"
                    ); 
        }
        echo json_encode( $files );  //return (ajax) list of photo-files
    }

    //action for delete photo from gallery
    public function actionDeleteFile($id) {
        /*header( 'Vary: Accept' );
        if( isset( $_SERVER['HTTP_ACCEPT'] ) && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
            header( 'Content-type: application/json' );
        } else {
            header( 'Content-type: text/plain' );
        }*/
        //DebugBreak();
        //$photo = Photo::model()->findByPk($id);
        //$success = $photo->delete();
        $success = true;
        
        echo json_encode( $success );       
    }
        
      //загрузка ландшафтных картинок (фотогалерея)
        public function  actionUploads() {
            $this->doUploads(Yii::app()->params['sizeGallery']);
        }

      //загрузка ландшафтных картинок (портреты)
        public function  actionUploadPortrait() {
            $this->doUploads(Yii::app()->params['sizePortrait']);
        }
        
      //action for upload of one photo
        private function  doUploads($sizes) {
            header( 'Vary: Accept' );
            if( isset( $_SERVER['HTTP_ACCEPT'] ) && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
                header( 'Content-type: application/json' );
            } else {
                header( 'Content-type: text/plain' );
            }
            $this->init( );
            
            $model = new PPhotoForm;
           
            $metrics = new stdClass();
            $metrics->sizeW = $sizes['sizeW']; //Yii::app()->params['sizeW']; //горизонтальный размер
            $metrics->sizeH = $sizes['sizeH']; //Yii::app()->params['sizeH']; //вертикальный размер
            $metrics->thumbSizeW = $sizes['thumb_sizeW']; //Yii::app()->params['thumb_sizeW']; //гориз. (иконка)
            $metrics->thumbSizeH = $sizes['thumb_sizeH']; //Yii::app()->params['thumb_sizeH']; //верт. (иконка)
            
            $fileObject = CUploadedFile::getInstance($model, 'file');
            $title = Yii::app()->request->getPost('imageName', '');
            $uploadPath = Yii::app()->UploadImageDir; //каталог загрузки
            $publicPath = Yii::app()->UploadImageLoc; //адрес картинок (урл)
            //We get the uploaded instance  
            $photo = $model->saveUpload($fileObject, $title, $uploadPath, $publicPath, $metrics);
            if (isset($photo))
            {   
            //Now we return our json
                echo json_encode( array( array(
                        "name" => $photo->orig_name, //$model->name,
                        "type" => $model->mime_type,
                        "size" => $model->size,
                        "title" => $model->title, //Add the title  And the description
                        "url" => Yii::app()->getUploadImageUrl($model->ImageName), //урл для картинки
                        "photo_id" =>$model->photoId,
                        "thumbnail_url" => Yii::app()->getUploadImageUrl($model->ThumbnailFilename), //урл для иконки
                        "delete_url" => $this->createUrl("/posting/deletefile", array("id" => $photo->photo_id)), //урл удаления
                        "delete_type" => "POST"     //тип: пост
                    ) ) );
            } else {
                echo json_encode(array(array("error" => $model->getErrors('file'))));
                Yii::log("XUploadAction: ".CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction");
            }
        }
        
    //private function actionVkapi()    
     
  //функция посылки API-запроса серверу VKontakte   
    public function sendApi($method, $parameters) {//DebugBreak();
        $vk_config = array(
            'app_id'        => '3584199', //'3548615',
            'api_secret'    => 'RGAULfbzeS4D2BRteVNv', //'v4C567RTG0rdwo3Ixpuu',
            'callback_url'  => Yii::app()->createAbsoluteUrl('/posting/default/getalbums'), //'http://localhost:8068/',
            'api_settings'  => 'friends,photos' // In this example use 'friends'.
            // If you need infinite token use key 'offline'.
        );

        try {
            $access_token = Yii::app()->user->getState('access_token');
            $access_token = $access_token['access_token'];
            $vk = new VK($vk_config['app_id'], $vk_config['api_secret'], $access_token);
            
            if (!isset($access_token) && !isset($_REQUEST['code'])) {
                /* If you need switch the application in test mode,
                 * add another parameter "true". Default value "false".
                 * Ex. $vk->getAuthorizeURL($api_settings, $callback_url, true); */
                $authorize_url = $vk->getAuthorizeURL($vk_config['api_settings'], $vk_config['callback_url']);
                Yii::app()->request->redirect($authorize_url);
                
            } else {
                if (!isset($access_token)) {
                    $url = Yii::app()->createAbsoluteUrl(Yii::app()->request->urlReferrer);
                    $access_token = $vk->getAccessToken($_REQUEST['code'], $vk_config['callback_url']);
                    Yii::app()->user->setState('access_token', $access_token);  //записываем  access_token в юзер-сессию
                }
                //DebugBreak();
                $response = $vk->api($method/*'photos.getAlbums'*/, $parameters/*array(
                    //'uid'       => '12345',
                    'aids' => 'profile,wall,saved',
                    'need_covers' => 1,
                )*/
                );
                
                if (isset($response['error']))
                   throw new VKException($response['error']['error_msg']);
                else
                   //return $response['response'];
                   return $response;
            }
        } catch (VKException $error) {
            return $error->getMessage();
        }
    }
    
     
//Получить альбомы юзера        
    public function actionGetAlbums() {//DebugBreak();
        $albums = $this->sendApi('photos.getAlbums', array('aids' => 'profile,wall,saved', 'need_covers' => 1));
        if (isset($albums['response'])) {
            $albums = $albums['response'];
            $dataProvider = new CArrayDataProvider($albums, array(
                'totalItemCount'=>count($albums),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));    
        } else 
            $errors = $albums['error'];
        
        $this->render('albums', array(
            //'photos' => $user_photos[response]
            'albums' => $albums,
            'dataProvider' => $dataProvider,
            'errors' => $errors,
        ));
    }

//Получить все фото юзера (http://vk.com/developers.php?o=-1&p=photos.get)      
    public function actionGetPhotos($album = 'profile,wall,saved') { 
      //если пришёл пост, то обработать входные данные и сохранить фото в БД
        if (isset($_POST['vkphotolist'])) {
            $photos = array(); //составить массив из ссылок
            foreach ($_POST['vkphotolist'] as $pid=>$value) {
                $photos[$pid]['src_big'] = $_POST['vkphotobig'][$pid];
                $photos[$pid]['src_small'] = $_POST['vkphotosmall'][$pid];
            }
            $count = count($photos);
          //если массив не пустой - добавить фото в БД
            if ($count) {   //сформировать текст запроса
                $connection = Yii::app()->db;
                $transaction = $connection->beginTransaction();                
                
                try {
                    $sql = "INSERT INTO photo(filename, thumb_filename) VALUES (:filename, :thumb_filename)";
                    $cmd = Yii::app()->db->createCommand($sql);
                    $photoIDs = array();
                    foreach ($photos as $pid=>$photo) {  
                        $rowcount = $cmd->execute(array(':filename' => $photo['src_big'], ':thumb_filename' => $photo['src_small']));
                        if ($rowcount)
                            $photoIDs[] = Yii::app()->db->lastInsertID;
                    }
                    if (!count($photoIDs))
                        throw new Exception('Ошибка! Не добавлено ни одной фотографии');
                    
                    $post_id = 1;
                    $lastOrderNR = Yii::app()->db->createCommand("SELECT max(order_nr) FROM photopost WHERE post_id = $post_id")->queryScalar();

                    $sql = "INSERT INTO photopost(post_id, photo_id, order_nr) VALUES \n\r";
                    foreach ($photoIDs as $photoID) {  
                        $sql .= '('.$post_id.', '.$photoID.', '.++$lastOrderNR.')';
                        if ($count-- > 1)
                            $sql .= ",\n\r";
                    }

                    $cmd = Yii::app()->db->createCommand($sql);
                    $rowcount = $cmd->execute();
                    if ($rowcount <> count($photoIDs))
                        throw new Exception('Количество добавленных записей в таблицу не равно заданному: '.$rowcount);
                    $transaction->commit();
                }
                catch(Exception $e) // в случае возникновения ошибки при выполнении одного из запросов выбрасывается исключение
                {
                    $transaction->rollback();
                    throw new CHttpException(500, $e->getMessage());
                }
            }
            $this->redirect(array('index'));  //редирект на индексную страницу
        }
        //DebugBreak();
      //иначе - вывести список фото из вконтакте
        $response = $this->sendApi('photos.get', array('aid' => $album));
        //$response = $this->sendApi('photos.getAll', array('aids' => $album/*'profile,wall,saved'*/, 'count' => 50));
        if (isset($response['response'])) {
            $photos = $response['response'];
            unset($photos[0]); //удалить первый элемент с кол-вом фото 
            foreach ($photos as $index=>$photo) {
                $photos[$index]['add_ref'] = $this->createAbsoluteUrl('/posting/default/addphoto', array('pid'=>'160017291_'.$photo['pid']));
            }
            $dataProvider = new CArrayDataProvider($photos, array(
                'totalItemCount'=>count($photos),
                'pagination'=>array(
                    'pageSize'=>32,
                ),
            ));    
        } else 
            $errors = $response['error'];
        
        $this->render('photos', array(
            //'photos' => $user_photos[response]
            'photos' => $photos,
            'dataProvider' => $dataProvider,
            'errors' => $errors,
        ));
    }    

    public function actionAddPhoto($pid) { DebugBreak();
        
        $response = $this->sendApi('photos.getById', array('photos' => $pid));
        if (isset($response['response'])) {
            $response = $response['response'];
            $photo = new Photo; 
            //Initialize the additional Fields, note that we retrieve the
            //$photo->description = $title;
                        
            //$photo->pmime_type = $this->_FileType;
            //$photo->pfilesize =  $this->getFileSize();
            $photo->filename = $response[0][src_big];
            $photo->orig_name = $response[0][src_big];
            
            //$photo->tfilesize =  $this->getTFileSize();
            //$photo->tmime_type = $this->_thumbnailFileType;
            $photo->thumb_filename = $response[0][src_small];
            //$photo->description = $title;
            $photo->save();
            //$this->_photo_id = $photo->photo_id;
            //return $photo->photo_id;
            return $photo;
        } else 
            $errors = $response['error'];
  }
  
}
