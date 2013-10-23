<?php

class ProposalController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','view'),
				'users'=>array('*'),
                //'roles'=>array(''),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('admin','manage','confirm','delete','indexNew'),
                'roles'=>array('admin', 'manager', 'index'),
            ),
            array('allow', // разрешение на вход в кабинет
                'actions'=>array(),
                'users'=>array('@'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
	//ДЕЙСТВИЕ: просмотр заявки
	public function actionView($id) {
		$model = $this->loadModel($id);
        $this->render('view',array( 
			'model'=>$model,
		));
	}

	//ДЕЙСТВИЕ: создание заявки
	public function actionCreate()
	{//DebugBreak();
		$this->checkIsFiling();
        Competition::checkIsProposal();
        
        $model = new Proposal;
        $userid = Yii::app()->request->getParam('userid');
        $model->competitionid = Yii::app()->competitionId;
        $model->userid = !empty($userid) ? $userid : Yii::app()->userId;
            
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proposal'])) {
			$model->attributes=$_POST['Proposal'];
            $model->competitionid = Yii::app()->competitionId;
            //$userid = Yii::app()->request->getParam('userid');
            $model->userid = !empty($userid) ? $userid : Yii::app()->userId;
			if ($success = $model->validate()) {
                if (!empty($model->commandid))   //если выбрана существующая команда
                    $model->commandname = '-';   //временно поставить значение поля
                else {
                    $command = new Command;
                    $command->CommandName = $model->commandname;
                    $command->competitionid = $model->competitionid;
                    
                    $success = $command->validate();
                    if (!$success) {
                        $model->addErrors($command->errors);
                    }
                    //$command->save();
                    //$model->commandid = $command->CommandID;
                }
            }
            if ($success) {
                $transaction = Yii::app()->db->beginTransaction();                         
                try {   
                    if ($command->save(false)) {
                        $model->commandid = $command->CommandID;
                        $model->save(false);
                    }
                    $transaction->commit();            
                    $success = true;
                } catch (Exception $e){
                    $transaction->rollBack();
                    //PJournalRecord::log($e->getMessage());
                    $success = false;
                    $error = $e->getMessage();
                }       
                if($success)
                    $this->redirect(array('view','id'=>$model->propid));
                else
                    throw new Exception(sprintf('Ошибка при сохранении заявки %d!', $model->commandname));  
            } else {
                $this->render('create',array('model'=>$model, /*'command'=>$command*/));    //рендерить вью - показать ошибки
            }
                
		} else {
            $user = Yii::app()->user->getModel();
            if (isset($user)) {
                $model->country = $user->country;
                $model->city = $user->city;
                $model->federation = $user->federation;
                $model->club = $user->club;
                $model->address = $user->address;
            }
            //рендерить вью
            $this->render('create',array('model'=>$model, ));
        }
	}

	//ДЕЙСТВИЕ: редактирование заявки
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proposal']))
		{
			$model->attributes=$_POST['Proposal'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->propid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	//ДЕЙСТВИЕ: удаление заявки
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('users/mycabinet'));
	}

    //ФУНКЦИЯ: взять логин из емейла
    private function getUniqueUsername($email) {
        $newusername = substr($email, 0, strpos($email, '@'));
        $index = 0;
        do {
            $findeduser = User::model()->find('username = :uname', array(':uname'=>$newusername));
            if ($findeduser)
                $newusername .= substr($email, strpos($email, '@') + 1, $index++);
        } while ($findeduser);
        return $newusername;
    }
    
  //функция: смена статуса заявки  
    private function changeStatus($id, $status) {
        $model = $this->loadModel($id);
        if (!isset($model))
            return false;

        if ($model->status == $status) {
            Yii::app()->user->setFlash('warning', ($status == Proposal::STATUS_ACTIVE ? 'Данная заявка уже активирована' : 'Данная заявка уже не активна'));
            $this->redirect(array('view','id'=>$id));
        }

        try {    //Старт ТРАНЗАКЦИИ
            $transaction = Yii::app()->db->beginTransaction();
            $success = $model->updateByPk($id, array('status'=>$status));  //обновить статус заявки
            if (!$success)
                throw new Exception(sprintf('Ошибка при смене статуса заявки %d. Текущий статус: "'.$model->statusTitle.'"!', $model->propid));  
            else
                Command::model()->updateByPk($model->commandid, array('status'=>$status)); //установить такой же статус для команды
            /*if ($status == Proposal::STATUS_ACTIVE) {                      //если данный процесс -Активация
                $command = Command::model()->findByPk($model->commandid);  //выбрать команду заявки
                if (isset($command))                                       
                    $command->status = Command::STATUS_ACTIVE;             //установить АКТИВНЫЙ статус для команды
                    $command->save('status');
            }*/
            $transaction->commit();            
            $success = true;
        } catch (Exception $e){
            $transaction->rollBack();
            //PJournalRecord::log($e->getMessage());
            $success = false;
            $error = $e->getMessage();
        }               

        
        if ($success) {
            $message_str = ($status == Proposal::STATUS_ACTIVE ? 'Заявка успешно подтверждена' : 'Заявка временно деактивирована');
            Yii::app()->user->setFlash('success', $message_str);  //создать алерт
            //отсылка по почте уведомления
            $object = MailSender::send(array($model->relUsers->Email), Yii::app()->params['emailsender']['templates'][($status == Proposal::STATUS_ACTIVE ? 'confirm' : 'cancel')]);
            if (!$object)
                Yii::app()->user->setFlash('warning', 'Ошибка при отсылке сообщения');
        } else
            Yii::app()->user->setFlash('error', $error);
        return $success;
    }
    
    //ДЕЙСТВИЕ: управление заявками
    public function actionConfirm($id) {
        if ($this->changeStatus($id, Proposal::STATUS_ACTIVE))
            $this->redirect(array('view','id'=>$id));
    }
	
    //ДЕЙСТВИЕ: управление заявками
    public function actionCancel($id) { 
        if ($this->changeStatus($id, Proposal::STATUS_NOACTIVE))
            $this->redirect(array('view','id'=>$id));
    }
    
    //ДЕЙСТВИЕ: просмотр списка заявок
    public function actionIndex() { 
        $criteria = new CDbCriteria;
        $criteria->with = array('relCommand');
        $criteria->condition = 't.competitionid = '.Yii::app()->competitionId;
        
        $dataProvider=new CActiveDataProvider('Proposal', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    
    //ДЕЙСТВИЕ: просмотр списка заявок
    public function actionManage() { 
        $criteria = new CDbCriteria;
        $criteria->with = array('relCommand');
        $criteria->condition = 't.competitionid = '.Yii::app()->competitionId;
        $dataProvider=new CActiveDataProvider('Proposal', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $this->render('manage',array(
            'dataProvider'=>$dataProvider,
        ));
    }
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Proposal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proposal']))
			$model->attributes=$_GET['Proposal'];

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
		$model=Proposal::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='proposal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
}
