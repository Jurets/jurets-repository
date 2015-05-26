<?php

class JudgeController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
                'users'=>array('*'),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('update'/*,'mycabinet','password'*/),
                'users'=>array('@'),
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin','delete','view'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Judge;          //создать модель судьи
        $model->user = new Users('create');  //создать связанную модель юзера
        $model->user->RoleID = 'judge';  //поставить роль = судья
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model->user);
        // приём данных из формы
		if(isset($_POST['Users']) && isset($_POST['Judge']))
		{ //DebugBreak();
			$model->user->attributes = $_POST['Users'];
            $model->attributes = $_POST['Judge'];
            $success_user = $model->user->validate();
            $success_judge = $model->validate();
            $success = $success_user && $success_judge;
            if ($success) {
                try {//DebugBreak();
                    $transaction = Yii::app()->db->beginTransaction();
                    $model->user->save();
                    $model->userid = $model->user->UserID;
                    $model->save();
                    $transaction->commit();
                } catch (Exception $e) {
                    $success = false;
                    $transaction->rollBack();
                    $error = $e->getMessage();
                }
                if ($success) {
                    EmailHelper::send(
                        array($model->user->Email),                   //кому
                        Yii::t('fullnames', 'Регистрация в системе'), //тема
                        'invitation',                                 //шаблон - вьюшка
                        array('user' => $model->user)                 //параметры
                    );
                    //если юзер = Гость - залогиниться с введённым паролем
                    if (Yii::app()->user->isGuest) {
                        $loginForm = new LoginForm;
                        $loginForm->username = $model->user->UserName;
                        $loginForm->password = $model->user->new_password;
                        $loginForm->login();
                        $this->redirect(array('users/mycabinet','id'=>$model->user->UserID));
                    } else {
                        $this->redirect(Yii::app()->createAbsoluteUrl(''));
                    }
                } else {
                    throw new CHttpException(400, 'Ошибка при регистрации судьи! Для разрешения проблемы свяжитесь с администратором сайта!');
                }
                //$this->redirect(array('view','id'=>$model->id));
            }
		}
		$this->render('create',array(
			'model'=>$model,
		));
        //$this->render('application.views.users.create',array('model'=>$user));
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Judge']))
		{
			$model->attributes=$_POST['Judge'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $criteria = new CDbCriteria;
        $criteria->with = array('judge');
        $criteria->condition = 't.competitionid = '.Yii::app()->competitionId;

        $dataProvider = new CActiveDataProvider('JudgeProposal', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Judge('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Judge']))
			$model->attributes=$_GET['Judge'];

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
		$model=Judge::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{//DebugBreak();
		if(isset($_POST['ajax']) && $_POST['ajax']==='judge-form')
		{
			$errors = CActiveForm::validate($model);
			echo $errors;
            Yii::app()->end();
		}
	}
}
