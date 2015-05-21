<?php

/**
 * This is the model class for table "command".
 *
 * The followings are the available columns in table 'command':
 * @property integer $CommandID
 * @property string $CommandName
 */
class Command extends CActiveRecord
{
    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = -1;

    public $sportsmen_count;
    public $coach_count;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Command the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'command';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('CommandName', 'required'),
            array('CommandName', 'unique', 'criteria'=>array(
                    'condition'=>'competitionid = :competitionid',
                        'params'=>array(':competitionid'=>Yii::app()->competitionId),
                    ),
                  'message'=>'Команда с таким именем уже зарегистрирована на данный турнир! Попробуйте другое название',
                  ),
            array('CommandName', 'length', 'max'=>50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('CommandName, secondname', 'safe'),
            //array('CommandID, CommandName, secondname', 'safe', 'on'=>'search'),
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
            'relSportsmen' => array(self::HAS_MANY, 'Sportsmen', 'CommandID'),
            'relCoach' => array(self::HAS_MANY, 'Coach', 'CommandID'),
            'sportsmenCount' => array(self::STAT, 'Sportsmen', 'CommandID'),
            'coachCount' => array(self::STAT, 'Coach', 'CommandID'),
            //'relProposal' => array(self::HAS_MANY, 'Proposal', 'commandid'), //схему "1 команда-много заявок" пока не применяем
            'relProposal' => array(self::HAS_ONE, 'Proposal', 'commandid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'CommandID' => Yii::t('fullnames', 'CommandID'),
            'CommandName' => Yii::t('fullnames', 'CommandName'),
            'sportsmenCount' => Yii::t('fullnames', 'sportsmenCount'),
            'coachCount' => Yii::t('fullnames', 'coachCount'),
            'Delegate' => Yii::t('fullnames', 'Delegate'),
            'city' => Yii::t('fullnames', 'City'),
            'secondname' => Yii::t('fullnames', 'secondname'),
        );
    }

    public static function commandCriteria() {
        $criteria = new CDbCriteria;
        //$criteria->join = 'INNER JOIN proposal ON proposal.commandid = t.commandid';
        //$criteria->addCondition('proposal.competitionid = :competitionid');
        $criteria->select = 't.*, '.
            '(SELECT COUNT(*) FROM sportsmen WHERE sportsmen.commandid = t.commandid AND status = 1) as sportsmen_count, '.
            '(SELECT COUNT(*) FROM coach WHERE coach.commandid = t.commandid) as coach_count';
        
        $criteria->addCondition('EXISTS (SELECT 1 from proposal P WHERE P.commandid = t.commandid '.
            //'AND P.competitionid = :competitionid '.
            'AND P.status = :status)');
        //$criteria->addCondition('t.status = 1 AND competitionid = :competitionid');
        $criteria->addCondition('t.status = 1');
        $criteria->params = array(
            //':competitionid'=>Yii::app()->competitionId, 
            ':status'=>Proposal::STATUS_ACTIVE
        );
        return $criteria;
    }
    
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        /*$criteria=new CDbCriteria;
        //$criteria->join = 'INNER JOIN proposal ON proposal.commandid = t.commandid';
        //$criteria->addCondition('proposal.competitionid = :competitionid');
        */
        $criteria = self::commandCriteria();
        //добавить связь с заявкой
        $criteria->with = array('relProposal', 'relProposal.relUsers');
        
        $criteria->compare('CommandID',$this->CommandID);
        $criteria->compare($this->getTableAlias() . '.competitionid',$this->competitionid);
        $criteria->compare('CommandName',$this->CommandName,true);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=> $this->tableAlias . '.CommandName ASC',
                'attributes'=>array(
                    'Delegate'=>array(
                        'asc'=>'relUsers.lastname ASC, relUsers.firstname ASC',
                        'desc'=>'relUsers.lastname DESC, relUsers.firstname DESC',
                    ),
                    'city'=>array(
                        'asc'=>'relProposal.city ASC, ' . $this->tableAlias . '.CommandName ASC',
                        'desc'=>'relProposal.city DESC, ' . $this->tableAlias . '.CommandName DESC',
                    ),  
                    'sportsmenCount'=>array(
                        'asc'=>'sportsmen_count ASC',
                        'desc'=>'sportsmen_count DESC',
                    ),
                    'coachCount'=>array(
                        'asc'=>'coach_count ASC, sportsmen_count ASC',
                        'desc'=>'coach_count DESC, sportsmen_count DESC',
                    ),
                    '*',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));
    }
    
    public function scopes() {
        return array(
            'competition'=>array(
                  'condition'=>$this->getTableAlias() . '.competitionid = :id',
                  'params'=>array(':id'=>Yii::app()->competitionId),
                  'order'=>'CommandName ASC',
            ),
            'withstat'=>array(
                'select' => 't.*, '.
                    '(SELECT COUNT(*) FROM sportsmen WHERE sportsmen.commandid = t.commandid AND status = 1) as sportsmen_count, '.
                    '(SELECT COUNT(*) FROM coach WHERE coach.commandid = t.commandid) as coach_count'
            )
        );    
    }
}
?>