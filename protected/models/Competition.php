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
			array('begindate, enddate, filingbegin, filingend', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, title, begindate, enddate, place, courtcount, filingbegin, filingend, isfiling, maxparticipants, addinfo', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
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
		
        if ($this->scenario == 'search_full') {
            $criteria->compare('courtcount',$this->courtcount);
		    $criteria->compare('filingbegin',$this->filingbegin,true);
		    $criteria->compare('filingend',$this->filingend,true);
		    $criteria->compare('isfiling',$this->isfiling);
		    $criteria->compare('maxparticipants',$this->maxparticipants);
        }
        
        $criteria->order = 'begindate DESC';
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
  //вернуть модель Соревнование (ИД берётся пока что из хардкода)
    public static function getModel()
    {
        $model = Competition::model()->findByPk(Yii::app()->competitionId);
        if($model===null)
            throw new CHttpException(404,'Запрашиваемая страница не найдена. Сообщите об ошибке организаторам соревнований');
        return $model;
    }

  //вернуть модель Соревнование (ИД берётся пока что из хардкода)
    public static function getModelPath($path)
    {
        $model = Competition::model()->findBySql('path = :path', array(':path'=>$path));
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
                   '(SELECT COUNT(*) FROM sportsmen WHERE status = 1) as realcount')
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
    public static function checkIsFiling() {
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
            throw new CHttpException(411, 'Запрещено подавать более одной заявки на соревнование! Вы уже подал заявку на данное соревнование. '.
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
            'SELECT "Количество спортсменов", (SELECT COUNT(*) FROM sportsmen S LEFT JOIN command C ON S.commandid = C.commandid WHERE C.status = 1 AND  S.status = 1 AND EXISTS ('.
                '(SELECT 1 from proposal P WHERE P.commandid = C.commandid AND P.status = 1))) FROM competition T WHERE T.id = :competitionid');
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
    
}