<?php

class CompetitionController extends Controller
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
				'actions'=>array('view', 'invite'/*, 'tosser', 'results'*/),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'manage'),
                'roles'=>array('admin','manager'),
				//'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
   
   private function getCompetitionStat() {
        $sqlCommand = Competition::sqlStat();
        $dataProvider = new CSqlDataProvider($sqlCommand->text, array(  
            'params'=>array(
                ':competitionid'=>Yii::app()->competitionId, 
                ':status'=>Proposal::STATUS_ACTIVE,
            ),
            'totalItemCount'=>3,
            'keyField'=>'statname',
        ));
        return $dataProvider;
   }

	//ДЕЙСТВИЕ: плакат-приглашение
	public function actionInvite()
	{//DebugBreak();
        $path = Yii::app()->request->getParam('path');
        $id = Yii::app()->request->getParam('id');
        
        $model = !empty($path) ? Competition::getModelPath($path) : Competition::getModel();
        $this->render('invitation',array(
            'model'=>$model,
            //'dataStat'=>$this->getCompetitionStat(), //$dataProvider,
		));
	}

    //ДЕЙСТВИЕ: просмотр
    public function actionView()
    {
        $this->render('view',array(
            'model'=>Competition::getModel(),
            'dataStat'=>$this->getCompetitionStat(), //$dataProvider,
        ));
    }

    //ДЕЙСТВИЕ: управление
    public function actionManage()
    {
        $this->render('manage',array(
            'model'=>Competition::getModel(),
            'dataStat'=>$this->getCompetitionStat(), //$dataProvider,
        ));
    }

	//ДЕЙСТВИЕ: редактирвоание
	public function actionUpdate()
	{
		$model=$this->loadModel(0);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Competition']))
		{
			$model->attributes=$_POST['Competition'];
			if($model->save())
				$this->redirect(array('manage','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	//функция: загрузить модель
	public function loadModel($id = 0)
	{
		$model=Competition::model()->findByPk(0);
		if($model===null)
			throw new CHttpException(404,'Запрашиваемая страница не найдена. Сообщите об ошибке организаторам соревнований');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='competition-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
