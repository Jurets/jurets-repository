<?php
YiiBase::import('application.controllers.ParticipantController');

class CoachController extends ParticipantController
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
            array(
                'application.filters.UserFilter + create, update',
            ),
            array(
                'application.filters.ViewcontestantsFilter + index, view',
            ),
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
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
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

	//ДЕЙСТВИЕ: Просмотр тренера
	public function actionView($id) {
        $model = $this->loadModel($id);
        //узнать ИД команды по текущему юзеру и запихнуть в модель
        $command = $this->getUserCommand();
        
        $breadcrumbs = array('Команды'=>array('command/index'));
        if (isset($command))
            $breadcrumbs = array_merge($breadcrumbs, array($command->CommandName=>array('command/view&id='.$command->CommandID.'#tab2')));
        $breadcrumbs = array_merge($breadcrumbs, array($model->CoachName));

		$this->render('view',array(
			'model'=>$model,
            'crumbs'=>$breadcrumbs/*array(
                'Команды'=>array('command/index'),
                $command->CommandName=>array('command/view&id='.$command->CommandID),
                'Просмотр тренера',
            )*/
		));
	}

	//ДЕЙСТВИЕ: Создать тренера
	public function actionCreate($id = null)
	{
		//проверка на доступность ввода заявок
        Competition::checkIsFiling();
        
        $model = new Coach;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        //узнать ИД команды по текущему юзеру и запихнуть в модель
        ////////if (Yii::app()->isExtendRole) 
        {                    //если расширенная роль
            $command = Command::model()->findByPk($id); //взять команду из входного параметра
        } //else
            ///////$command = $this->getUserCommand();        //иначе - по юзеру

		if(isset($_POST['Coach']))
		{
			$model->attributes=$_POST['Coach'];
			if($model->save())
                //$this->redirect(array('/command/view/id/'.$command->CommandID.'#command_tab_2'));
                //$this->redirect(Yii::app()->createAbsoluteUrl('/command/view', array('id'=>$command->CommandID, '#command_tab2')));
                $this->redirect(Yii::app()->createAbsoluteUrl('/command/view', array('id'=>$command->CommandID, 'tab'=>'2')));
		}

        //$commandid = $command->CommandID;
        if ((!isset($command->CommandID) || empty($command->CommandID)) && !Yii::app()->isExtendRole) {
            throw new CHttpException(400, 'Запрещены действия по вводу информации! Вы являетесь представителем команды и не прикреплены ни к одной команде!'.
              'Для разрешения проблемы свяжитесь с организаторами соревнований'); }
        else {
		    $model->CommandID = $command->CommandID;

            $breadcrumbs = array('Команды'=>array('command/index'));
            if (isset($command))
                $breadcrumbs = array_merge($breadcrumbs, array($command->CommandName=>array('command/view&id='.$command->CommandID.'#tab2')));
            $breadcrumbs = array_merge($breadcrumbs, array('Добавить тренера'));

            $this->render('create',array(
			    'model'=>$model,
                'extendRole'=>Yii::app()->isExtendRole,
                'crumbs'=>$breadcrumbs/*array(
                    'Команды'=>array('command/index'),
                    $command->CommandName=>array('command/view&id='.$command->CommandID),
                    'Добавить тренера',
                )*/
		    ));
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        //узнать ИД команды по текущему юзеру и запихнуть в модель
        if (Yii::app()->isExtendRole) {                    //если расширенная роль
            $commandid = $model->CommandID; //взять команду из входного параметра
        }
        else
            $commandid = $this->getUserCommand()->CommandID;        //иначе - по юзеру
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Coach']))
		{
			$model->attributes=$_POST['Coach'];
			if($model->save()) {
                $this->redirect(array('/command/view/'.$commandid.'#command_tab_2'));
				//$this->redirect(array('/command/view', 'id'=>$commandid, '#tab2'));
            }
		}

        $breadcrumbs = array('Команды'=>array('command/index'));
        if (isset($command))
            $breadcrumbs = array_merge($breadcrumbs, array($command->CommandName=>array('command/view&id='.$command->CommandID.'#tab2')));
        $breadcrumbs = array_merge($breadcrumbs, array($model->CoachName=>array('coach/view&id='.$model->CoachID), 'Редактировать'));
        
		$this->render('update',array(
			'model'=>$model,
            'crumbs'=>$breadcrumbs,
		));
	}

	//ДЕЙСТВИЕ: удалить тренера
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
        $command = $this->loadModel($id)->Command;
        $model->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/command/view&id='.$command->CommandID.'#tab2'));
	}

	//ДЕЙСТВИЕ: показать полный список тренеров
	public function actionIndex() {
		//$dataProvider = new CActiveDataProvider('Coach');
        $count = Coach::getCoachCount(); //Yii::app()->db->createCommand('SELECT COUNT(*) FROM Sportsmen')->queryScalar();
        $sqlCommand = Coach::sqlCoachList();
        $dataProvider = new CSqlDataProvider($sqlCommand->text, array(
            'totalItemCount'=>$count,
            'keyField'=>'CoachID',
            /*'sort'=>array(
                'attributes'=>array(
                    'Fullname',
                ),
            ),*/
            'params'=>array(
                ':competitionid'=>Yii::app()->competitionId, 
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));    

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Coach('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Coach']))
			$model->attributes=$_GET['Coach'];

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
		$model=Coach::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='coach-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
