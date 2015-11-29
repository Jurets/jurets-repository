<?php

/**
 * This is the model class for table "competition".
 *
 * The followings are the available columns in table 'competition':
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $begindate
 * @property string $enddate
 * @property string $place
 * @property integer $courtcount
 * @property string $filingbegin
 * @property string $filingend
 * @property integer $isfiling
 * @property integer $maxparticipants
 */
class Competition extends CActiveRecord
{
    const TYPE_COMPETITION = 'competition';
    const TYPE_CAMP = 'camp';
    const TYPE_MAIN = 'main';
    const FLG_ACTIVE = 1;    // активное (показывается на главной странице)
    const FLG_NONACTIVE = 0;  // не активное (показывается на главной странице)
    const FLG_ARCH = -1;      // в архиве
    
    //флаг: было ли изменение в поле "главная страница"
    public $isInviteChanged = false;
    
    // загруженные документы
    public $files = array();
    
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Competition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
    //@return string the associated database table name
	public function tableName()
	{
		return 'competition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name, title', 'required'),
			array('id, courtcount, isfiling, maxparticipants', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('title, place, addinfo', 'length', 'max'=>255),
			array('begindate, enddate, filingbegin, filingend, isInviteChanged, path', 'safe'),  //"invitation" убираем из безопасных атрибутов, а флаг добавляем
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('id, name, title, begindate, enddate, place, courtcount, filingbegin, filingend, isfiling, maxparticipants, addinfo', 'safe', 'on'=>'search'),
            array('tosserstatus, tossercontent', 'safe', 'on'=>'tosser'),
			array('resultstatus, resultcontent', 'safe', 'on'=>'result'),
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
            'relProposal' => array(self::HAS_MANY, 'Proposal', 'competitionid'),
		);
	}

    /**
     *  Именованные условия (скоупы). Применение:
     *  - Competition::model()->active()->find(...)
     * 
     * @return array scopes.
     */
    public function scopes()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'active' => array(
                  //'condition'=>$this->getTableAlias() . '.isfiling = :flag',
                  'condition'=>'competition.isfiling = :flag',
                  'params'=>array(':flag'=>self::FLG_ACTIVE), 
            ),
            'nonactive' => array(
                  'condition'=>'competition.isfiling = :flag',
                  'params'=>array(':flag'=>self::FLG_NONACTIVE), 
            ),
            'archive' => array(
                  'condition'=>'competition.isfiling = :flag',
                  'params'=>array(':flag'=>self::FLG_ARCH), 
            ),
            'visible' => array(
                  //'condition'=>'competition.isfiling <> :flag AND competition.isfiling <> :flag2',
                  'condition'=>'competition.isfiling <> :flag',
                  'params'=>array(':flag'=>self::FLG_ARCH),
            ),
            'subdomain' => array(
                  'condition'=>'COALESCE(competition.subdomain, "") <> ""',
            ),
            'noitf' => array(
                'condition'=>'competition.type <> :type',
                'params' => array('type'=>'itf'),  // временно! для отфильтр-ия ИТФ
            ),
        );
    }
    
    public function defaultScope() {
        return array(
            'alias'=>'competition',
            'order'=>'competition.begindate DESC',
        );
    }    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('fullnames', 'Name'),
			'title' => Yii::t('fullnames', 'Title'),
			'begindate' => Yii::t('fullnames', 'Begin date'),
			'enddate' => Yii::t('fullnames', 'End date'),
			'place' => Yii::t('fullnames', 'Place'),
			'courtcount' => Yii::t('fullnames', 'Court count'),
			'filingbegin' => Yii::t('fullnames', 'Filing begin'),
			'filingend' => Yii::t('fullnames', 'Filing end'),
			'isfiling' => Yii::t('fullnames', 'Isfiling'),
            'maxparticipants' => Yii::t('fullnames', 'Max participants'),
            'path' => Yii::t('fullnames', 'Path'),
			'files' => Yii::t('fullnames', 'Documents'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($scopes = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
        
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('begindate',$this->begindate,true);
		$criteria->compare('enddate',$this->enddate,true);
		$criteria->compare('place',$this->place,true);
        
        if (isset($scopes)) {
            $criteria->scopes = $scopes;
        } else {
            $criteria->scopes = array('visible', 'noitf');
        }
		
        if ($this->scenario == 'search_full') {
            $criteria->compare('courtcount',$this->courtcount);
		    $criteria->compare('filingbegin',$this->filingbegin,true);
		    $criteria->compare('filingend',$this->filingend,true);
		    $criteria->compare('isfiling',$this->isfiling);
		    $criteria->compare('maxparticipants',$this->maxparticipants);
        }
        
        //$criteria->order = 'begindate DESC';
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20, //5,
            ),
		));
	}
    
  //вернуть модель Соревнование (ИД берётся пока что из хардкода)
    public static function getModel($id = null)
    {
        if (empty($id)) {
            $id = Yii::app()->competitionId;
            //$id = self::competitionIdWithAges(); //вычислить ИД соревнования
        }
        $_cacheID = 'cacheCompetition' . $id;
        $model = Yii::app()->cache->get($_cacheID);   //проверить кэш
        if ($model === false) {
            $model = Competition::model()->findByPk($id);
            Yii::app()->cache->set($_cacheID, $model, 30);  //3600 = 1 час
        }
        if($model===null)
            throw new CHttpException(404,'Запрашиваемая страница не найдена. Сообщите об ошибке организаторам соревнований');
        return $model;
    }

  //вернуть модель Соревнование (ИД берётся пока что из хардкода)
    public static function getModelPath($path)
    {
        if ($path == 'gii')
            return true;
        $model = Competition::model()->findByAttributes(array('path'=>$path));
        if($model===null)
            throw new CHttpException(404,'Запрашиваемая страница не найдена. Сообщите об ошибке организаторам соревнований');
        return $model;
    }
    
  //вернуть модель Соревнование (ИД берётся пока что из хардкода)
    public static function loadModel()
    {
        $compId = Yii::app()->competitionId;

        $criteria = new CDbCriteria;
        $criteria->select = 't.*, Unix_timestamp(begindate) as begindate, Unix_timestamp(enddate) as enddate, Unix_timestamp(filingbegin) AS filingbegin, Unix_timestamp(filingend) AS filingend';
        $criteria->condition = 'id = :id';
        $criteria->params = array(':id'=>$compId);
        
        //$model = Competition::model()->findByPk(Yii::app()->competitionId);
        $model = Competition::model()->find($criteria);
        if($model===null)
            throw new CHttpException(404,'Запрашиваемая страница не найдена. Сообщите об ошибке организаторам соревнований');
        return $model;
    }

    /**
    * после сохранения объекта Соревнования
    */
    public function afterSave() {
        $_cacheID = 'cacheCompetition' . Yii::app()->competitionId;
        Yii::app()->cache->delete($_cacheID);  //очистить кэш
    }
    
    //выдать следующий ИД соревнования
    public static function getNewID() {
        //узнать максимальный ИД из существующих
        $id = Yii::app()->db->createCommand()
            ->select('MAX(id)')
            ->from(self::model()->tableName())
            ->queryScalar();
        return isset($id) ? ($id + 1) : 0;
    }
    
    
    public static function getCompetitionParam($param) {
        $model = self::getModel();
        $res = $model[$param];
        return $res;
    }
    
    public static function getCompetitionPeriod()
    {
        /*$cmd = Yii::app()->db->createCommand('SELECT Unix_timestamp(begindate) as begindate, Unix_timestamp(enddate) as enddate, Unix_timestamp(filingbegin) AS filingbegin, Unix_timestamp(filingend) AS filingend FROM competition WHERE id = :id');
        $cmd->bindParam(':id', Yii::app()->competitionId);
        $row = $cmd->queryRow();*/
        $compId = Yii::app()->competitionId;
        $sqlCommand = Yii::app()->db->createCommand()
            ->select(array(
                   'Unix_timestamp(begindate) as begindate',
                   'Unix_timestamp(enddate) as enddate',
                   'Unix_timestamp(filingbegin) AS filingbegin',
                   'Unix_timestamp(filingend) AS filingend'))
            ->from('competition')
            ->where('id = :id')
            ->bindParam(':id', $compId);
        $row = $sqlCommand->queryRow();
        if($row === null)
            throw new CHttpException(404,'Запрашиваемая страница не найдена. Сообщите об ошибке организаторам соревнований');
        return $row;
    }
    
    
    //СТАТ: узнать ограничение по кол-ву спортсменов
    public static function getSpMaxLimitCount() {
        //$count = Yii::app()->db->createCommand('SELECT maxparticipants FROM competition LIMIT 1')->queryScalar();
        //return $count;
        $model = self::getModel();
        return $model['maxparticipants'];
    }

    //ПРОВЕРКА: не превысило ли ограничение по кол-ву спортсменов
    public static function checkForSportsmenLimit() {
        $competitionId = Yii::app()->competitionId;
        $sqlCommand = Yii::app()->db->createCommand()
            ->select(array(
                   'maxparticipants',
                   '(SELECT COUNT(*) FROM sportsmen S LEFT JOIN command C ON C.commandid = S.commandid WHERE C.competitionid = :id AND S.status = 1) as realcount')
            )->from('competition')
            ->where('id = :id')
            ->bindParam(':id', $competitionId);
        $row = $sqlCommand->queryRow();
        //$count = Yii::app()->db->createCommand('SELECT maxparticipants FROM competition LIMIT 1')->queryScalar();
        //return $count;
        //$model = self::getModel();
        return $row['realcount'] < $row['maxparticipants'];
    }
    
    //СТАТ: узнать ограничение по кол-ву спортсменов
    public static function checkIsFiling() {//DebugBreak();
        $isfilling = self::getCompetitionParam('isfiling');
        if (!$isfilling)
            throw new CHttpException(410, 'Запрещен ввод информации! На данный момент регистрация участников запрещена. '.
            'При необходимости свяжитесь с организаторами соревнований');
    }
    
    //УЗНАТЬ: есть ли заявка от пользователя на соревнование
    public static function checkIsProposal() {
        $userid_posted = Yii::app()->request->getParam('userid');
        if (empty($userid_posted))
            $userid = Yii::app()->userid;
        else
            $userid = $userid_posted;
            
        $isProp = Proposal::isProposalForCompetition(Yii::app()->competitionId /*self::getModel()->id*/, $userid);
        if ($isProp)
            throw new CHttpException(411, 'Вы уже подали заявку на данное соревнование. '.
                'Можете отказаться от заявки, удалив её, а затем создав новую. '.
                'При необходимости свяжитесь с организаторами соревнований');
    }
    
    public static function sqlStat() {
        //$criteria = new CDbCriteria;
        //$criteria->s
        $sqlCommand = Yii::app()->db->createCommand(
            'SELECT "Количество команд" AS statname, (SELECT COUNT(*) FROM command C WHERE C.competitionid = T.id AND EXISTS ('.
                '(SELECT 1 from proposal P WHERE P.commandid = C.commandid AND P.status = :status))) AS statvalue FROM competition T WHERE T.id = :competitionid '. 
            ' UNION '.
            'SELECT "Количество тренеров", (SELECT COUNT(*) FROM coach C LEFT JOIN command CC ON C.commandid = CC.commandid WHERE CC.status = 1 AND EXISTS ('.
                '(SELECT 1 FROM proposal P WHERE P.commandid = C.commandid AND P.competitionid = :competitionid AND P.status = :status))) FROM competition T WHERE T.id = :competitionid'.
            ' UNION '.
            'SELECT "Количество спортсменов", (SELECT COUNT(*) FROM sportsmen S LEFT JOIN command C ON S.commandid = C.commandid WHERE C.status = 1 AND S.status = 1 AND EXISTS ('.
                '(SELECT 1 FROM proposal P WHERE P.commandid = C.commandid AND P.competitionid = :competitionid AND P.status = :status))) FROM competition T WHERE T.id = :competitionid');
        return $sqlCommand;
    }
    
   public static function getCompetitionStat() {
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
   
   //является ли тип соревнования лагерем (сборы)
   public function getIsCamp(){
        return ($this->type == self::TYPE_CAMP); 
   }
   
   //является ли тип соревнования соревнованием
   public function getIsCompetition(){
        return ($this->type == self::TYPE_COMPETITION); 
   }
   
   //является ли тип соревнования главной страницей (не лагерь, не турнир)
   public function getIsMain(){
        return ($this->type == self::TYPE_MAIN); 
   }
}