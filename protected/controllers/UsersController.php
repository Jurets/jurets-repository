<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	// @return array action filters
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
            array(
                'application.filters.UserFilter + update',
                //'unit'=>'second',
            ),		
        );  
	}

    
	// Specifies the access control rules. This method is used by the 'accessControl' filter.
	// @return array access control rules
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','mycabinet','password','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin','delete','activate','deactivate'),
				'roles'=>array('admin','manager'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	// Displays a particular model. @param integer $id the ID of the model to be displayed
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//Competition::checkIsFiling();
        $model = new Users('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save(true)) {
				$success = EmailHelper::send(
                    array($model->Email),                         //кому
                    Yii::t('fullnames', 'Регистрация в системе'), //тема
                    'invitation',                                 //шаблон - вьюшка
                    array('user' => $model)                       //параметры
                );
                //если юзер = Гость - залогиниться с введённым паролем
                if (Yii::app()->user->isGuest) {
                    $loginForm = new LoginForm;
                    $loginForm->username = $model->UserName;
                    $loginForm->password = $model->new_password;
                    $loginForm->login();
                    $this->redirect(array('mycabinet','id'=>$model->UserID));
                } else
                    $this->redirect(Yii::app()->createAbsoluteUrl(''));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save(true)) {
                //пока отключаем данную отсылку (нужно ли оно???????????????)
                /*$success = EmailHelper::send( //отослать сообщение о смене персональных данных
                    array($model->Email),    //кому
                    Yii::t('fullnames', 'Изменение персональных данных'), //тема
                    'changedata',            //шаблон - вьюшка
                    array('user' => $model)  //параметры
                );*/
				$this->redirect(array('view','id'=>$model->UserID));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users', 
            array(
                'pagination'=>array(
                    'pageSize'=>50,
                ),
            )
        );
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

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
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    //ДЕЙСТВИЕ: Мой Кабинет
    public function actionMycabinet()
    {
        //$userid = Yii::app()->user->getUserid();
        $userid = Yii::app()->user->userID;
        /*$url = $this->createUrl('/proposal/view',array('id'=>$propid));
        //$proposalid = 
        //$url = $this->createUrl('/proposal/view',array('id'=>$proposalid));
        $this->redirect($url);*/

        if (isset($userid)) {
            $model = $this->loadModel($userid);
            if (isset($model))
                $this->render('view',array('model'=>$model));
        }
        //$this->actionView($propid);
    }
    
    //действие: Активировать юзера
    private function changeStatus($id, $status) {
        $model = $this->loadModel($id);
        if (!isset($model))
            return false;

        if ($model->Active == $status) {
            Yii::app()->user->setFlash('warning', 'У пользователя уже установлен данный статус: '.($status == Users::STATUS_ACTIVE ? 'активен' : 'неактивен'));
            $this->redirect(array('view','id'=>$id));
        }
        $success = $model->changeStatus();
        //$this->redirect(array('view','id'=>$model->UserID));
        //else
            //$this->render('view',array('model'=>$model));
        if ($success) {
            $message_str = ($status == Users::STATUS_ACTIVE ? 'Пользователь успешно активирован' : 'Пользователь успешно деактивирован');
            //Yii::app()->user->setFlash('success', $message_str);  //создать алерт
            $mailsuccess = EmailHelper::send(  //отсылка мейла о активации / деактивации
                array($model->Email),                         //кому
                Yii::t('fullnames', ($status == Users::STATUS_ACTIVE ? 'Активация учётной записи' : 'Деактивация учётной записи')), //тема
                ($status == Users::STATUS_ACTIVE ? 'useractivation' : 'userdeactivation'), //шаблон - вьюшка
                array('user' => $model)                       //параметры
            );
            if ($mailsuccess)
                Yii::app()->user->setFlash('success', $message_str . '. Сообщение о смене статуса пользователя успешно отослано на его e-mail');
            else
                Yii::app()->user->setFlash('warning', $message_str . 'Ошибка при отсылке сообщения');
        } else {
            Yii::app()->user->setFlash('error', 'Ошибка при попытке изменить статус');
        }
        return $success;
    }

    //действие: Активировать юзера
    public function actionActivate($id) {
        if ($this->changeStatus($id, Users::STATUS_ACTIVE))
            $this->redirect(array('view','id'=>$id));
    }

    //действие: Дективировать юзера
    public function actionDeactivate($id) {
        if ($this->changeStatus($id, Users::STATUS_NOACTIVE))
            $this->redirect(array('view','id'=>$id));
    }

    //действие: Сменить пароль юзера
    public function actionPassword($id, $auto = null) 
    {
        $model = $this->loadModel($id);
        if(isset($auto) || isset($_POST['Users']))
        {
            $model->scenario = isset($auto) ? 'autopassword' : 'password';
            if (!empty($_POST['Users'])) {
                $model->attributes = $_POST['Users'];
            }
            if($model->save(true, array('Password', 'Salt'))) 
            {
                if (isset($auto)) {
                    $success = EmailHelper::send( //отослать сообщение на емейл
                        array($model->Email),                //кому
                        Yii::t('fullnames', 'Новый пароль'), //тема
                        'autopassword',                      //шаблон - вьюшка
                        array('user' => $model)              //параметры
                    );
                        
                    if ($success)
                        Yii::app()->user->setFlash('success', 'Сообщение о новом пароле пользователя успешно отослано на его e-mail');
                    else
                        Yii::app()->user->setFlash('warning', 'Ошибка при отсылке сообщения');
                } else
                    Yii::app()->user->setFlash('success', 'Пароль успешно изменён');

                $this->redirect(array('view','id'=>$model->UserID));
            } else if (isset($auto))
                $this->redirect(array('view','id'=>$model->UserID));
        }

        $this->render('password',array(
            'model'=>$model,
        ));
    }
    
}
