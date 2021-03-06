<?php
YiiBase::import('posting.models.*');
//YiiBase::import('application.controllers.ParticipantController');
Yii::app()->bootstrap->register();
                               
class CommandController extends Controller //ParticipantController
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
                'application.filters.ViewcontestantsFilter + view',
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
                //'roles'=>array('admin','manager'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','manage'),
                'roles'=>array('admin', 'manager'),
				//'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function beforeCommandAction($model) {//DebugBreak();
        //$status = isset($model->relProposal) ? $model->relProposal->status : null;
        if ($model->status == Proposal::STATUS_NEW) {
            throw new CHttpException(421, 'Запрещен просмотр данных для команды, заявка которой не подтверждена! ' . "\n" .
                'Команда: ' . $model->CommandName);
            Yii::app()->end();
        }
    }

	//ДЕЙСТВИЕ: просмотр команды
	public function actionView($id, $path = '') {
        $tabnum = Yii::app()->request->getParam('tab');
        $tabnum = !empty($tabnum) ? $tabnum : 1;
        //загрузить модель со всеми связями
        $model = $this->loadModelAll($id);
        //проверка перед просмотром
        $this->beforeCommandAction($model);
        
        //загрузить список спортсменов
        //$sqlCommand = Sportsmen::sqlSportsmenList($model->CommandID);
        //DebugBreak();
        // построить модель ля фильтра
        $modelSportsmen = new Sportsmen('search');
        $modelSportsmen->unsetAttributes();  // clear any default values
        if(isset($_GET['Sportsmen']))
            $modelSportsmen->attributes=$_GET['Sportsmen'];
        // сформировать критерию
        $criteria = new CDbCriteria;
        $criteria->alias = 'S';
        $criteria->select = array('S.SpID', 'CONCAT(S.lastname, " ", S.firstname) AS FullName', 'S.BirthDate', 'S.AgeID', 'S.fullyears', 'S.persontul');
        $criteria->with = array(//'relCommand',  //'relPhoto', 
            'relFst' => array('select'=>'FstName'),
            'relCategory' => array('select'=>'relCategory.CategoryName'),
            'relAttestlevel' => array('select'=>'relAttestlevel.AttestLevel'),
            'relAgecategory' => array('select'=>'relAgecategory.AgeName'),
            'relWeightcategory' => array('select'=>array('relWeightcategory.WeightFrom', 'relWeightcategory.WeightTo')),
            'relCoach' => array('select'=>'relCoach.CoachName'),
            'relCoachFirst' => array('select'=>'relCoachFirst.CoachName as Coachname1'),
            'relPhoto' => array('select'=>'relPhoto.filename'),
        );
        $criteria->addCondition(array('S.status = :status', 'S.commandid = :commandid'));
        $criteria->params = array(':commandid'=>$model->CommandID, ':status'=>1);
        // Добавить собственно фильтр
        $criteria->compare('CONCAT(S.lastname, " ", S.firstname)', $modelSportsmen->FullName, true);
        $criteria->compare('S.AgeID', $modelSportsmen->searchAgeName);
        $criteria->compare('S.Coach1ID', $modelSportsmen->searchCoachName);
        //$criteria->compare('CommandID',$this->CommandID);
        
        // сформирвоать провайдер набора данных
        $dataSportsmenList = new CActiveDataProvider('Sportsmen', array(
            'criteria'=>$criteria,
            'totalItemCount'=>$model->sportsmen_count,
            'sort'=>array(
                'defaultOrder'=>'CONCAT(S.lastname, " ", S.firstname) ASC',
                'defaultOrder'=>'S.lastname, S.firstname ASC',
                'attributes'=>array(
                    'FullName'=>array(
                        'asc'=>'S.lastname, S.firstname ASC',
                        'desc'=>'S.lastname, S.firstname DESC',
                    ),
                    'searchAgeName'=>array(
                        'asc'=>'age.ordernum ASC',
                        'desc'=>'age.ordernum DESC',
                    ),
                    'WeightNameFull'=>array(
                        'asc'=>'weigth.WeightFrom ASC',
                        'desc'=>'weigth.WeightFrom DESC',
                    ),                    
                    'searchCoachName'=>array(
                        'asc'=>'relCoach.CoachName ASC',
                        'desc'=>'relCoach.CoachName DESC',
                    ),
                    '*'),
            ),
            'pagination'=>array(
                'pageSize'=>50,
            ),
        )); 

        //загрузить список тренеров
        $sqlCommand = Coach::sqlCoachList($model->CommandID);
        $dataCoachList = new CSqlDataProvider($sqlCommand->text, array(
            'totalItemCount'=>$model->coach_count, //$count,
            'keyField'=>'CoachID',
            'pagination'=>array(
                'pageSize'=>10,
            ),
        )); 
        
        //вывести вьюшку
		$this->render('view',array(
            'model'=>$model,
			'modelSportsmen'=>$modelSportsmen,
            'commandid'=>$model->CommandID,
            'dataSportsmenList'=>$dataSportsmenList,
            'dataCoachList'=>$dataCoachList,
            'tabnum'=>$tabnum,
            'filterAges'=>Agecategory::getAges(), //выборка категорий соревнования (возрастные с весовыми)
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Command;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Command']))
		{
			$model->attributes=$_POST['Command'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->CommandID));
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

        //$uid = Yii::app()->userid;
        //$flg = $this->isUserOwner($uid, $model);
        $myCommandID = Yii::app()->user->getCommandid(); //ИД Моей команды
        $isMyCommand = !Yii::app()->user->isGuest && ($model->CommandID == $myCommandID);
        $flg = Yii::app()->user->isExtendRole() || $isMyCommand;

        if (!$flg) {
            if (Yii::app()->user->isGuest)
                $mess = 'Запрещено редактировать! Вы вошли как Гость.'.
                        ' Для того, чтобы иметь возможность ввода информации, необходимо войти как зарегистрированный пользователь';
            else //if (isset($uid) && !empty($uid))
                $mess = 'Запрещено редактировать! Данная команда введена другим пользователем';
            throw new CHttpException(400, $mess);
            return;
        }
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        // если пришли данные редактирвоания из формы:
		if(isset($_POST['Command'])) {
			$model->attributes = $_POST['Command'];
			if ($model->save(false, array('CommandName', 'secondname'))) {
                // !TODO : продумать систему возврата на страницу, с которой была вызвана форма редактирования
                //if (true) {
                    $this->redirect(array('view','id'=>$model->CommandID));
                //} else {}
            }
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Удаление команды
     *  - подразумевает установку статуса равным НУЛЮ (т.н. деактивация)
	 *  - если удаление НЕ через аякс, то редирект на стр. "команды"
	 * @param integer $id ИД команды
	 */
	public function actionDelete($id)
	{//DebugBreak();
        $db = Yii::app()->db;
        $transaction = $db->beginTransaction();
        try {
            //деактивировать спортсменов
            $db->createCommand()->update('sportsmen', array('status'=>Sportsmen::STATUS_NOACTIVE), 'commandid = :commandid', array(':commandid'=>$id));
            //'DELETE FROM coach WHERE commandid = :commandid')->execute();
            
            //$db->createCommand('UPDATE proposal SET status = 0 WHERE commandid = :commandid')->execute(array(':commandid'=>$id));
            $db->createCommand()->update('proposal', array('status'=>Command::STATUS_NOACTIVE), 'commandid = :commandid', array(':commandid'=>$id));
            
            $model = $this->loadModel($id);
            $model->status = Proposal::STATUS_NOACTIVE;
            //$this->loadModel($id)->delete();
            $model->save();
            
            $transaction->commit();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        } catch (Exception $e){
            $transaction->rollBack();
            $success = false;
            $error = $e->getMessage();
        } 
	}

	//ДЕЙСТВИЕ: просмотр списка команд
	public function actionIndex()
	{
        //данные для списка команд
        $model = New Command;
        $model->competitionid = Yii::app()->competitionId;
        $dataProvider = $model->search();
        //данные по статистике
        $dataStat = Competition::getCompetitionStat();
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'dataStat'=>$dataStat,
		));
	}

    //ДЕЙСТВИЕ: просмотр списка команд
    public function actionManage()
    {
        //данные для списка команд
        $model = New Command;
        $model->competitionid = Yii::app()->competitionId;
        $dataProvider = $model->search();
        //данные по статистике
        $dataStat = Competition::getCompetitionStat();
        
        $this->render('manage',array(
            'dataProvider'=>$dataProvider,
            'dataStat'=>$dataStat,
        ));
    } 
       
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Command('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Command']))
			$model->attributes=$_GET['Command'];

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
		$model = Command::model()->withstat()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Не найдена команда с ИД: ' . $id);
		return $model;
	}

    
    public function loadModelAll($id)
    {
        $model = Command::model()->with('relProposal', 'relProposal.relUsers')->withstat()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'Не найдена команда с ИД: ' . $id);
        return $model;
    }
    
    /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='command-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
