<?php

class WeightcategoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
				'actions'=>array('tosser', 'tosserold', 'list', 'results', 'getweightlist','category'/*, 'index','view'*/),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','tossnumset'),
				'roles'=>array('admin','manager'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new Weightcategory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Weightcategory']))
		{
			$model->attributes=$_POST['Weightcategory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->WeightID));
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Weightcategory']))
		{
			$model->attributes=$_POST['Weightcategory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->WeightID));
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
		$dataProvider=new CActiveDataProvider('Weightcategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Weightcategory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Weightcategory']))
			$model->attributes=$_GET['Weightcategory'];

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
		$model=Weightcategory::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='weightcategory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
  //ДЕЙСТВИЕ: смотреть жеребъёвку
    public function actionTosserOld() {
        $arrcategory = array();
        $ages = Agecategory::model()->findAll();
        foreach ($ages as $aid=>$age) {
            $arrcategory[$aid] = array(
                 'id' => $age->AgeID,
                 //'text' => '<a href="/admin/catalog/category/id/'.$category->id.'">'.$category->category_name.'</a>',
                 'text' => $age->AgeName,//$age->AgeNameYear(),
                 'expanded' => false,
            );
            $weigths = Weightcategory::model()->findAll('AgeID = :ageid', array(':ageid'=>$age->AgeID));
            foreach ($weigths as $wid=>$weigth) { //DebugBreak();
                $sportsmens = $this->weightlist($weigth->WeightID);
                $arrcategory[$aid]['children'][$wid] = array(
                    'id' => $weigth->WeightID,
                    //'text' =>  '<a href="/admin/catalog/item/id/'.$item->id.'">'.$item->article.'</a>',
                    'text' => $weigth->WeightNameFull(),
                    'sportsmens' => $sportsmens,
                );
            }
        }
        $this->render('tosser', array('arrcategory'=>$arrcategory));
    }
    

  //ДЕЙСТВИЕ: смотреть жеребъёвку
    private function getList($amode = 'short', $wmode = 'full') {
        $arrcategory = array();
        //$allSportsmens = $this->allweightlist();
        $sqlCommand = Sportsmen::sqlTosserList();
        $allSportsmens = Yii::app()->db->createCommand($sqlCommand->text)->queryAll();
        //список возрастов (кэш)
        $ages = Agecategory::getAges();
        //список весовых по возрастным
        foreach ($ages as $aid=>$age) {
            $arrcategory[$aid] = array(
                 'id' => $age->AgeID,
                 'text' => $amode == 'full' ? $age->AgeNameYear : $age->AgeName,
                 'expanded' => false,
                 'children' => array(),
            );
            //$weigths = Sportsmen::getWeigthsList($age->AgeID);  //список весов (кэш)  ----- так много запросов
            $weigths = $age->relWeigths;  //список весов (из связанной модели по жадной загрузке) --- так лучше ))
            foreach ($weigths as $wid=>$weigth) {
                //$sportsmens = $this->weightlist($weigth->WeightID);  
                $sportsmens = $this->filterWeightlist($allSportsmens, $weigth->WeightID);
                $count = $this->countWeightlist($allSportsmens, $weigth->WeightID);
                $arrcategory[$aid]['children'][$wid] = array(
                    'id' => $weigth->WeightID,
                    'text' => $wmode == 'full' ? $weigth->WeightNameFull : $weigth->WeightNameShort,
                    'sportsmens' => $sportsmens,
                    'count' => $count,
                );
            }
        }
        return $arrcategory;
    }
    
  //ДЕЙСТВИЕ: смотреть жеребьевку
    public function actionList() {
        $this->render('list', array('arrcategory'=>$this->getList()));
    }

  //ДЕЙСТВИЕ: смотреть жеребъёвку
    public function actionTosser() {
        $arrcategory = array();
        //$allSportsmens = $this->allweightlist();
        $sqlCommand = Sportsmen::sqlTosserList();
        $allSportsmens = Yii::app()->db->createCommand($sqlCommand->text)->queryAll();
        //список возрастов (кэш)
        $ages = Agecategory::getAges();
        
        $weigth = new Weightcategory;
        $tosserManager = $weigth->tosserManager;
        //список весовых по возрастным    
        foreach ($ages as $aid=>$age) {
            $arrcategory[$aid] = array(
                 'id' => $age->AgeID,
                 'text' => $age->AgeName,//$age->AgeNameYear(),
                 'expanded' => false,
            );
            $weigths = Sportsmen::getWeigthsList($age->AgeID);  //список весов (кэш)  
            
            foreach ($weigths as $wid=>$weigth) { 
                //$sportsmens = $this->weightlist($weigth->WeightID);  
                $sportsmens = $this->filterWeightlistTosser($allSportsmens, $weigth->WeightID);
                $sportsmencount = $sportsmens->totalItemCount;
                $figthcount = Weightcategory::getFigthCount($sportsmencount);
                $levelCount = Weightcategory::getLevelCount($figthcount);
                $arrcategory[$aid]['children'][$wid] = array(
                    'id' => $weigth->WeightID,
                    'text' => $weigth->WeightNameFull,
                    'sportsmencount' => $sportsmencount,
                    'figthcount' => $figthcount,
                    'levelcount' => $levelCount,
                    'tosserGrid' => $weigth->tosserGrid['grids'][16],
                    'sportsmens' => $sportsmens,
                );
            }
        }
        $this->render('tosser', array(
            'tosserManager' => $tosserManager,
            'arrcategory'=>$arrcategory,
        ));
    }

    //выдать список спортсменов весовой категории
    public function filterWeightlistTosser($sportsmens, $wid) {
        $filteredList = array(); 
        foreach($sportsmens as $index => $item) {
            if ($item['WeigthID'] == $wid)
                $filteredList[] = $item;
        }
        $dataProvider = new CArrayDataProvider($filteredList, array(
            'totalItemCount'=>count($filteredList),
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));    
        return $dataProvider;
    }          

    //выдать кол-во спортсменов весовой категории
    public function countWeightlist($sportsmens, $wid) {
        $filteredList = array();
        foreach($sportsmens as $index => $item) {
            if ($item['WeigthID'] == $wid)
                $filteredList[] = $item;
        }
        return count($filteredList);
    }    
    
    //выдать список спортсменов весовой категории
    public function filterWeightlist($sportsmens, $wid) {
        $filteredList = array();
        foreach($sportsmens as $index => $item) {
            if ($item['WeigthID'] == $wid)
                $filteredList[] = $item;
        }
        return $filteredList;
    }          
    
    //ДЕЙСТВИЕ: смотреть жеребъёвку
    public function actionResults() {
        $this->render('results');
    }

    //выдать список спортсменов весовой категории
    public function weightlist($wid) {
        //if (isset($_REQUEST['weigthid'])) 
        {
            //$wid = $_REQUEST['weigthid'];
            $count = Sportsmen::getSportsmenCount($wid); 
            $sqlCommand = Sportsmen::sqlWeightmenList($wid);
            $dataProvider = new CSqlDataProvider($sqlCommand->text, array(
                'totalItemCount'=>$count,
                /*'sort'=>array(
                    'attributes'=>array(
                        'Fullname',
                    ),
                ),*/
                'pagination'=>array(
                    'pageSize'=>50,
                ),
            ));    
            
            
            return $this->renderPartial('/sportsmen/_weigthlist',array(
                'commandid'=>null,
                'dataProvider'=>$dataProvider,
                //'wcache'=>'wcid_'.$wid,
                'isCache'=>true,
                'weigthid'=>$wid,
            ), true, false);
        }
    }        
    
    //выдать список спортсменов весовой категории
    public function allweightlist() {
        $sqlCommand = Sportsmen::sqlWeightmenList($wid);
        
        $dataProvider = new CSqlDataProvider($sqlCommand->text, array(
            'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));    
    }            
    
    //выдать список спортсменов весовой категории
    public function actionGetweightlist() {   
        if (isset($_REQUEST['weigthid'])) {
            $wid = $_REQUEST['weigthid'];
            $count = Sportsmen::getSportsmenCount($wid); 
            $sqlCommand = Sportsmen::sqlWeightmenList($wid);
            $dataProvider = new CSqlDataProvider($sqlCommand->text, array(
                'totalItemCount'=>$count,
                /*'sort'=>array(
                    'attributes'=>array(
                        'Fullname',
                    ),
                ),*/
                'pagination'=>array(
                    'pageSize'=>20,
                ),
            ));    
            
            
            $this->renderPartial('/sportsmen/_weigthlist',array(
                'commandid'=>null,
                'dataProvider'=>$dataProvider,
                'wcache'=>'wcid_'.$wid,
            ), false, true);
        }
    }    

    public function actionTossnumset($id) {
        $weigthid = $id;
        //$sqlCommand = 'select from sportsmen'.(isset($weigthid) ? ' where weigthid = '.$weigthid : '');
        $sqlselect = 'select spid from sportsmen where weigthid = :weigthid';
        $commandselect = Yii::app()->db->createCommand($sqlselect);
        $commandselect->bindParam(':weigthid', $weigthid, PDO::PARAM_INT);

        $sqlupdate = 'update sportsmen set tossnum = :tossnum where spid = :spid'; ;
        $commandupdate = Yii::app()->db->createCommand($sqlupdate);
        
        $rows = $commandselect->queryAll();
        //$arrtoss = array();
        //for($i = 1; $i <= count($rows); $i++)
        //    $arrtoss[$i] = $i;
        $arrtoss = range(1,count($rows));
        shuffle($arrtoss);
        
        foreach($rows as $key=>$row) {
            //$tossnum = rand(1, count($rows));
            //$tossnum = $arrtoss[$tossnum];
            $tossnum = $arrtoss[$key];
            $commandupdate->bindParam(':spid', $row['spid'], PDO::PARAM_INT);
            $commandupdate->bindParam(':tossnum', $tossnum, PDO::PARAM_INT);
            $commandupdate->execute();
            //unset($arrtoss[$tossnum]);
        }
    }
    
    public function actionGetweigthsByAge($id) {
        $dataProvider = new CActiveDataProvider('Weightcategory', array('AgeID'=>$id));
        $this->renderPartial('_weigthsbyage',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    
    //список + кол-во по категориям
    public function actionCategory() {
        $this->render('category', array('arrcategory'=>$this->getList('full', 'short')));
    }
}

