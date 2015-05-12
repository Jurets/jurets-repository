<?php

/**
 * This is the model class for table "proposal".
 *
 * The followings are the available columns in table 'proposal':
 * @property integer $propid
 * @property string $federation
 * @property string $country
 * @property string $city
 * @property string $club
 * @property string $address
 * @property integer $participantcount
 * @property string $comment
 * @property integer $status
 * @property integer $commandid
 * @property string $userid
 * */
class Proposal extends ProposalBase
{
    public $modeCommand = self::COMMAND_EXIST;   //режим ввода заявки
    public $commandname;   //введенная (новая) команда
    
    // Returns the static model of the specified AR class.
	// @param string $className active record class name. * @return Proposal the static model class
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// @return string the associated database table name
	public function tableName()
	{
		return 'proposal';
	}

	// @return array validation rules for model attributes.
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            //array('commandname, commandid, country, city, participantcount', 'required'),
			array('commandname, country, city, participantcount', 'required'),
            array('participantcount, status', 'numerical', 'integerOnly'=>true),
			//////////array('participantcount', 'checkMaxParticipants'),  //временно!!!!!!!!!!!!!!!!!!!!!!!!
			array('commandname, federation', 'length', 'max'=>100),
			array('city', 'length', 'max'=>30),
			array('country, club', 'length', 'max'=>50),
			array('address', 'length', 'max'=>255),
            //проверки на уникальность
            //array('commandname', 'unique'),
            array('comment, userid, commandid, commandname', 'safe'),
            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('propid, commandname, federation, post, country, city, club, address, participantcount, comment, status', 'safe', 'on'=>'search'),
		);
	}
    
    //ограничение на максимальное кол-во участников
    public function checkMaxParticipants($attribute, $params) {
        if (isset(Yii::app()->params['maxParticipants'])) {
            $max = Yii::app()->params['maxParticipants'];
            if (!empty($max) && is_integer($max) && $this->participantcount > $max)
                $this->addError('participantcount', 'Максимальное количество участников в заявке не должно превышать ' . $max);
        }
    }
    
    public function checkEmailForExist($attribute, $params) {
        //$this->_identity = new UserIdentity($this->username,$this->password);
        if (User::model()->find('Email = :email', array(':email'=>$this->email)))
            $this->addError('email','Данный адрес email уже зарегистрирован');
    }

    public function checkLoginForExist($attribute, $params) {
        //$this->_identity = new UserIdentity($this->username,$this->password);
        if (User::model()->find('UserName = :uname', array(':uname'=>$this->login)))
            $this->addError('login','Данный логин уже зарегистрирован');
     }
    
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'relCompetition' => array(self::BELONGS_TO, 'Competition', 'id'),
            'relCommand' => array(self::BELONGS_TO, 'Command', 'commandid'),
            'relUsers' => array(self::BELONGS_TO, 'Users', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(parent::attributeLabels(), array(
			'propid' => 'ИД',
			'commandname' => Yii::t('fullnames', 'Command'),
			'firstname' => Yii::t('fullnames', 'FirstName'),
			'lastname' => Yii::t('fullnames', 'Прізвище'),
			'participantcount' => Yii::t('fullnames', 'Participant count'),
			'login' => Yii::t('fullnames', 'Login'),
            
			'commandid' => Yii::t('fullnames', 'Command'),
			'modeCommand' => Yii::t('fullnames', 'Mode'),
		));
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

		$criteria->compare('propid',$this->propid);
		$criteria->compare('commandname',$this->commandname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('federation',$this->federation,true);
		$criteria->compare('post',$this->post,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('club',$this->club,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('www',$this->www,true);
		$criteria->compare('participantcount',$this->participantcount);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
    public function searchNew()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'status = 0';
        
        return  new CActiveDataProvider($this,array(
            //'criteria'=>$criteria,
        ));
    }

    //критерия для поиска заявки пользователя на соревнование
    private static function criteriaPropForCompetition($competitionid, $userid) {
        $criteria = new CDbCriteria;
        $criteria->select = '*';  // выбираем все поля
        $criteria->addCondition('userid = :userid');
        $criteria->addCondition('competitionid = :competitionid');
        $criteria->params = array(':userid'=>$userid, ':competitionid'=>$competitionid);
        return $criteria;
    }
    
    //возвращает заявку пользователя на соревнование
    public static function proposalForCompetition($compid, $userid) {//DebugBreak();
    //!!! НЕ записывать заявку в сессию - получаются НЕАКТУАЛЬНЫЕ данные (пример - после активации)    
        /*$user = Yii::app()->user;
        if ($proposal = $user->getState('userProposal'))
            return $proposal;
        else*/ {
            $proposal = self::model()->find(self::criteriaPropForCompetition($compid, $userid));
            //$user->setState('userProposal', $proposal); 
        }
        return $proposal;
    }    

    //определение - есть ли заявка пользователя на соревнование
    public static function isProposalForCompetition($compid, $userid){
        $criteria = self::criteriaPropForCompetition($compid, $userid);
        return self::model()->exists($criteria);
    }    
}