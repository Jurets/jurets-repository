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
				'actions'=>array('view', 'invite', 'archive', 'archiveold'/*, 'tosser', 'results'*/),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', /*'manage', */'exportcsv', 'create', 'tosserupdate', 'resultupdate', 'exportcsvitf'),
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
	{
        $path = Yii::app()->request->getParam('path');
        $id = Yii::app()->request->getParam('id');
        
        $this->pathCompetition = isset($path) ? $path : '';
        
        $model = !empty($path) ? Competition::getModelPath($path) : Competition::getModel($id);
        $this->render('invitation',array(
            'model'=>$model,
            //'dataStat'=>$this->getCompetitionStat(), //$dataProvider,
		));
	}

    /**
    * ДЕЙСТВИЕ: просмотр соревнования / управление (для менеджера)
    * 
    */
    public function actionView()
    {
        $this->render('view',array(
            'model'=>Competition::getModel(),
            'dataStat'=>$this->getCompetitionStat(),
        ));
    }

    /**
    * экспорт списка участников сорвенования в CSV-файл
    */
    public function actionExportcsv()
    {
        Yii::import('ext.csv.ECSVExport');
        $outputFile = 'participants.csv';
        $competition = Competition::getModel();
        // выборка
        $select = array('F.AgeName', 'F.FullName', 'F.Commandname', 'F.FstName', 'F.BirthYear', 'F.CategoryName', 'F.attestlevel', 'F.Gender', 'F.WeightNameFull', 'F.Coaches', 'F.competitionid', 'F.city', 'F.spid');
        if ($competition->type == 'itf') {
            $select[] = "if((S.persontul = 1), 'да', null) AS persontul";
            $select[] = "S.fullyears";
            $select[] = "S.persontul AS division_sparring";
            $select[] = "S.persontul AS division_tul";
        }
        $cmd = Yii::app()->db->createCommand()
            ->select($select)
            ->from('fulllist F')
            ->leftJoin('sportsmen S', 'S.SpID = F.spid')
            ->where('competitionid = :competitionid');
        $cmd->params = array(':competitionid'=>Yii::app()->competitionId);
        // создание CSV компонета 
        $csv = new ECSVExport($cmd, true, true, ';');
        $csv->delimiter = ';';
        if ($competition->type == 'itf') {
            $csv->setCallback(function($row) {
                // определение дивизиона для тулей и спарринга
                $divisions = Agecategory::getDivisions();
                foreach ($divisions['personal_tul'] as $division) {
                    if (in_array($row['Attestlevel'], $division['levels'])) {
                        $row['division_tul'] = $division['name'];
                        break;
                    }
                }
                foreach ($divisions['personal_sparring'] as $division) {
                    if (in_array($row['Attestlevel'], $division['levels'])) {
                        $row['division_sparring'] = $division['name'];
                        break;
                    }
                }
                return $row;
            });
        }
        $csv->setOutputFile($outputFile);
        $csv->toCSV(); // returns string by default
         
        //echo file_get_contents($outputFile);
        $content = file_get_contents($outputFile);
        Yii::app()->getRequest()->sendFile($outputFile, $content, "text/csv", false);
    }
    
    /**
    * экспорт списка участников сорвенования в CSV-файл
    */
    public function actionExportcsvitf($program = 'sparring')
    {
        Yii::import('ext.csv.ECSVExport');
        $outputFile = 'participants_' . $program . '.csv';
        //$competition = Competition::getModel();
        // выборка
        $select = array(
            'F.AgeName', 
            'F.FullName', 'F.Commandname', 'F.FstName', 
            'S.fullyears', 'F.CategoryName', 'F.attestlevel', 'F.Gender', 'F.WeightNameFull', 'F.Coaches', 
            "if((S.persontul = 1), 'да', null) AS persontul",
            "S.persontul AS division",
            //"S.persontul AS division_sparring",
            //"S.persontul AS division_tul",
            "concat(U.lastname, ' ', substr(U.firstname, 1, 1), '.') AS UserName",
            'F.city', 'F.spid',
        );
        $cmd = Yii::app()->db->createCommand()
            ->select($select)
            ->from('fulllist F')
            ->leftJoin('sportsmen S', 'S.SpID = F.spid')
            //->leftJoin('command C', 'C.CommandID = S.CommandID')
            ->leftJoin('proposal P', 'P.commandid = S.CommandID')
            ->leftJoin('user U', 'U.UserID = P.userid')
            ->where('F.competitionid = :competitionid');
        if ($program == 'sparring') {
            $cmd->andWhere('F.WeightNameFull IS NOT NULL');
        } else if ($program == 'tul') {
            $cmd->andWhere('S.persontul = 1');
        }
        $cmd->params = array(':competitionid'=>Yii::app()->competitionId);
        
        // создание CSV компонета 
        $csv = new ECSVExport($cmd, true, true, ';');
        $csv->delimiter = ';';
        if ($program == 'sparring') {
            $csv->setCallback(function($row) {
                // определение дивизиона для тулей и спарринга
                $divisions = Agecategory::getDivisions('personal_sparring');
                $row = $this->rowProcess($row, $divisions);
                $row['AgeName'] .= ' (' . $row['division'] . ')';
                return $row;
            });
        } else if ($program == 'tul') {
            $csv->setCallback(function($row) {
                // определение дивизиона для тулей и спарринга
                $divisions = Agecategory::getDivisions('personal_tul');
                $row = $this->rowProcess($row, $divisions);
                return $row;
            });
        }
        $csv->setOutputFile($outputFile);
        $csv->toCSV(); // returns string by default
         
        //echo file_get_contents($outputFile);
        $content = file_get_contents($outputFile);
        Yii::app()->getRequest()->sendFile($outputFile, $content, "text/csv", false);
    }
    
    private function rowProcess($row, $divisions) {
        foreach ($divisions as $division) {
            if (in_array($row['Attestlevel'], $division['levels'])) {
                $row['division'] = $division['name'];
                break;
            }
        }
        if (!empty($row['Coaches'])) {
            if (strpos($row['Coaches'], '.')) {
                $coach = $row['Coaches'];
            } else {
                $coach = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $row['Coaches']);
            }
            $row['FullName'] .= ' ('.$coach.')';
        } else {
            $row['FullName'] .= ' ('.$row['UserName'].')';
        }
        return $row;
    }
    
    //ДЕЙСТВИЕ: создание
    public function actionCreate() {
        $model = New Competition();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['Competition'])) {
            $model->attributes = $_POST['Competition'];
            if (empty($model->id)) { //если не определен ИД соревнования, то поставить авто
                $model->id = Competition::getNewID();
            }
            if ($model->isInviteChanged) { //если было изменение главной страницы - то сохраняем его
                $model->invitation = $_POST['Competition']['invitation'];
            }
            if($model->save()) {
                Yii::app()->user->setFlash('success', 'Новое соревнование успешно добавлено: ' . $model->path . ' (ИД: ' . $model->id . ')');
                $this->redirect(array('view'));
            }
        }
        $this->render('update',array(
            'model'=>$model,
        ));
    }

	//ДЕЙСТВИЕ: редактирование
	public function actionUpdate($id = null) {
		if ($id === null) {
            $id = Yii::app()->competitionId;
        }
        $model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Competition'])) {
			$model->attributes = $_POST['Competition'];
            if ($model->isInviteChanged) { //если было изменение главной страницы - то сохраняем его
                $model->invitation = $_POST['Competition']['invitation'];
            }
			if($model->save()) {
                $this->redirect(array('view'));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	//функция: загрузить модель
	public function loadModel($id = 0)
	{
		$model=Competition::model()->findByPk($id);
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
    
    /**
    * Вывод архива соревнований (временно): результаты
    */
    public function actionArchive() {
        // ссылка-указание для старой архив-ленты
        $str = 'Для просмотра старой архивной ленты нажмите ссылку: ' . CHtml::link('Старая лента', Yii::app()->createAbsoluteUrl('archiveold'));
        Yii::app()->user->setFlash('warning', $str);
        // выдать вьюшку со списком архивных турниров
        $competition = Competition::getModel();
        $this->render('application.views.competition.invitation',array(
            'competition'=>$competition,
            'dataProvider'=>(new Competition())->search(array('archive', 'subdomain')), // archive
        ));
    }

    /**
    * Старый архив (временно, для совмещения)
    */
    public function actionArchiveold() {
        $this->render('archive');
    }
    
    // общая функция
    private function updateContent($id, $page_name) {
        if ($id === null) {
            $id = Yii::app()->competitionId;
        }
        $model = $this->loadModel($id);
        $model->scenario = $page_name;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Competition'])) {
            $model->attributes = $_POST['Competition'];
            //if ($model->isInviteChanged) { //если было изменение главной страницы - то сохраняем его
            //    $model->invitation = $_POST['Competition']['invitation'];
            //}
            if($model->save()) {
                // загрузка файлов
                $model->files = CUploadedFile::getInstances($model, 'files');
                if (!empty($model->files)) {
                    $_ = DIRECTORY_SEPARATOR;
                    $path = Yii::app()->basePath .$_ .'..'.$_.'document'.$_.$page_name.$_;
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                        chmod($path, 0777);
                    }
                    foreach ($model->files as $file) {
                        $file->saveAs($path . $file->name);
                    }
                }
                $this->redirect(array('weightcategory/'.$page_name));
            }
        }
        // вывести вьюшку
        $this->render('tosserupdate',array(
        //$this->render($page_name.'update',array(
            'model'=>$model,
            'content_field'=>$page_name.'content',
            'status_field'=>$page_name.'status',
        ));
    }    
    
    /**
    * ДЕЙСТВИЕ: редактирование ;tht,m`dtb
    * 
    * @param mixed $id
    */
    public function actionTosserupdate($id = null) {
        $this->updateContent($id, 'tosser');
    }
    
    /**
    * ДЕЙСТВИЕ: редактирование результата
    * 
    * @param mixed $id
    */
    public function actionResultupdate($id = null) {
        $this->updateContent($id, 'result');
    }
    
}
