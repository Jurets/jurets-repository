<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $UserID
 * @property string $UserName
 * @property string $Password
 * @property string $Salt
 * @property integer $CommandID
 * @property string $lastname
 * @property string $firstname
 * @property string $middlename
 * @property string $UserFIO
 * @property string $Email
 * @property integer $Active
 */
class Users extends CActiveRecord
{
    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = -1;

    public $old_password;
    public $new_password;
    public $retype_password;
    
    public $searchUserFio;
    public $verifyCode; //параметр для добавления валидационных правил капчи
    
	// Returns the static model of the specified AR class. 
    // @param string $className active record class name. @return Users the static model class
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// @return string the associated database table name
	public function tableName()
	{
		return 'user';
	}

	// @return array validation rules for model attributes.
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Email, firstname, lastname, country, city', 'required', 'on' => 'create, createJudge'),
            array('UserName, Password, RoleID, firstname, lastname, country, city', 'required', 'on' => 'update'),
			array('CommandID, Active, status', 'numerical', 'integerOnly'=>true),
			array('UserName', 'length', 'max'=>100),
            array('firstname, post, city', 'length', 'max'=>30),
			array('Password, Salt, lastname, country, club', 'length', 'max'=>50),
			array('UserFIO, federation, phone, Email', 'length', 'max'=>100),
            array('address, www', 'length', 'max'=>255),
            array('comment', 'safe'),
            //специальные проверки
            //array('Email', 'safe', 'on'=>'autopassword'),
            array('UserName', 'safe', 'on'=>'autopassword'),
            //array('Email', 'required', 'on'=>'autopassword'),
            array('UserName', 'required', 'on'=>'autopassword'),
            array('Email', 'email', 'on'=>array('create', 'update', 'autopassword')),
            //array('Email', 'exist', 'on'=>'autopassword', 'message'=>Yii::t('controls', 'This Email not found')),
            array('UserName', 'exist', 'on'=>'autopassword', 'message'=>Yii::t('controls', 'This user not found')),
            //проверки на уникальность
            array('UserName', 'unique', 'on' => 'create'), //array('UserName, Email', 'unique', 'on' => 'create'),
            //проверять эти поля при смене пароля (сценарий "password")
            array('old_password, new_password, retype_password', 'safe', 'on'=>'password'), 
            //array('Email', 'checkEmailForExist'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('UserID, UserName, Password, RoleID, Salt, CommandID, Email, Active, searchUserFio', 'safe', 'on'=>'search'),
			array('UserFIO', 'unsafe', 'on'=>'search'),
            //array('propid, commandname, firstname, lastname, federation, post, country, city, club, address, phone, email, www, participantcount, comment, login, status', 'safe', 'on'=>'search'),
            array('new_password', 'length', 'min'=>4, 'max'=>50),
            array('new_password', 'match', 'pattern'=>'/^[a-zA-Z0-9]+$/', 'on'=>array('create','update'), 'message'=>'Разрешены только латинские буквы и цифры'),
            //проверка капчи
            array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements()),
            //array('verifyCode', 'captcha', 'on' => 'create'),
        );
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
            //'relCommand' => array(self::HAS_ONE, 'Command', 'CommandID'),
            'relProposal' => array(self::HAS_MANY, 'Proposal', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'UserID' => 'ИД',
			'UserName' => 'Пользователь',
			'Password' => 'Пароль',
			'Salt' => 'Salt',
			'CommandID' => 'Команда',
			'UserFIO' => 'ФИО',
			'Email' => 'Email',
			'Active' => 'Акт',

            'lastname' => Yii::t('fullnames', 'LastName'),
            'firstname' => Yii::t('fullnames', 'FirstName'),
            'federation' => Yii::t('fullnames', 'Federation'),
            'post' => Yii::t('fullnames', 'Post'),
            'country' => Yii::t('fullnames', 'Country'),
            'city' => Yii::t('fullnames', 'City'),
            'club' => Yii::t('fullnames', 'Club'),
            'address' => Yii::t('fullnames', 'Address'),
            'phone' => Yii::t('fullnames', 'Phone'),
            'email' => Yii::t('fullnames', 'E-mail'),
            'www' => Yii::t('fullnames', 'www'),
            'participantcount' => Yii::t('fullnames', 'Participant count'),
            'comment' => Yii::t('fullnames', 'Comment'),
            'status' => Yii::t('fullnames', 'Status'),
            'login' => Yii::t('fullnames', 'Login'),
            
            'old_password' => Yii::t('fullnames', 'Old password'),
            'new_password' => Yii::t('fullnames', 'New password'),
            'retype_password' => Yii::t('fullnames', 'Retype password'),
            'created' => Yii::t('fullnames', 'Date Create'),
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

		$criteria->compare('UserID',$this->UserID);
        $criteria->compare('UserName',$this->UserName,true);
		$criteria->compare('CONCAT(lastname, " ", firstname)',$this->searchUserFio,true);
		$criteria->compare('CommandID',$this->CommandID);
		//$criteria->compare('UserFIO',$this->UserFIO,true);
		$criteria->compare('Email',$this->Email,true);
        $criteria->compare('Active',$this->Active);
		$criteria->compare('RoleID',$this->RoleID);
//        DebugBreak();
        //$criteria->order = 'UserID DESC';
                        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
            'sort'=>array(
                'defaultOrder'=>'UserID DESC', 
                'attributes'=>array(
                    'searchUserFio'=>array(
                        'asc'=>'lastname, firstname',
                        'desc'=>'lastname, firstname DESC',
                    ),
                    '*',
                ),
            ),
    	));
	}

    
    public function loadModel($id)
    {
        $model = Users::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    public function getUserFIO()
    {
        return $this->lastname . ' ' . $this->firstname;
    }
    
    public function getStatusTitle() {
        if ($this->status == self::STATUS_NEW) return 'Новый';
        if ($this->status == self::STATUS_NOACTIVE) return 'Не активен';
        if ($this->status == self::STATUS_ACTIVE) return 'Активен';
    }
    
    public function getStatusCss() {
        return ($this->status == self::STATUS_NEW ? 'warning' : ($this->status == self::STATUS_NOACTIVE ? 'important' : 'success'));
    }
    
    //Jurets: encrypt password with MD5 RSA Data Security
    public function hashPassword($pwstr, $salt) {
        return md5($salt.$pwstr);
    }
    //Jurets: compare entered password with saved in DB
    public function validatePassword($pwstr) {
 
        return ($this->hashPassword($pwstr, $this->Salt) === $this->Password);
    }
    
    //функция генерации пароля
    public function generatePassword($lenght)
    {
        $password = '';
        //набор символов для пароля
        $symbols = array('a','b','c','d','e','f',
                         'g','h','i','j','k','l',
                         'm','n','o','p','r','s',
                         't','u','v','x','y','z',
                         'A','B','C','D','E','F',
                         'G','H','I','J','K','L',
                         'M','N','O','P','R','S',
                         'T','U','V','X','Y','Z',
                         '1','2','3','4','5','6',
                         '7','8','9');
     
        //запускаем цикл с количеством витков $lenght
        for($i = 0; $i < $lenght; $i++)
        {
            //случайным образом выбираем номер символа из массива $symbols для вставки в новый пароль
            $index = rand(0, count($symbols) - 1);
            //склеиваем точкой имеющийся $password со случайным символом $symbols[$index]
            $password = $password.$symbols[$index];
        }
     
        //возвращаем новый пароль
        return $password;
    }
    
    //функция перед записью: инициализация значений
    public function beforeSave() {
        if ($this->isNewRecord) {
            //$this->Active = self::STATUS_NOACTIVE; //юзер при создании НЕАКТИВЕН
            $this->status = self::STATUS_NEW; //юзер при создании НЕАКТИВЕН
            $this->UserName = $this->Email; //начальный логин = емейл
            $this->Salt = rand(1,9999);     //сгенерить соль
            if (empty($this->new_password)) { //если пароль не был введён юзером - сгенерить автоматический
                $password = $this->generatePassword(rand(6,10));  // пароль будет от 6 до 10 символов
                $this->new_password = $password; //сохранить исходный текст пароля (для отправки)
            }
            $this->Password = $this->hashPassword($this->new_password, $this->Salt); //хешить пароль
            if (empty($this->RoleID)) {
                $this->RoleID = 'delegate';  //по умолчанию роль = представитель
            }
        } else if ($this->scenario == 'activity') {
            return true;                                                                 
        } //автогенерация пароля
        else if ($this->scenario == 'autopassword' || $this->scenario == 'password') {
            if ($this->scenario == 'autopassword') { //автогенерация пароля
               $this->new_password = $this->generatePassword(rand(6,10));
            } else if ($this->scenario == 'password') { //смена пароля юзером
                if ($this->Password <> $this->hashPassword($this->old_password, $this->Salt))
                    $this->addError('Password', Yii::t('fullnames', 'Your typed old password do not match with your current existing password'));
                else if ($this->new_password <> $this->retype_password)
                    $this->addError('Password', Yii::t('fullnames', Yii::t('fullnames', 'Your typed new password do not match with retyped value')));
            }
            $success = !$this->hasErrors('Password');
            if ($success) {
                $id = $this->UserID;
                $this->Salt = rand(1,9999);     //сгенерить новую соль
                $this->Password = $this->hashPassword($this->new_password, $this->Salt);  //хешить новый пароль
            } else {
                return false;
            }            
        }
        return parent::beforeSave()/* && $this->validate()*/;
    }
    
    //Активация пользователя (1 - активировать, 0 - деактивировать)
    public function changeStatus(/*$activity = self::STATUS_ACTIVE*/) 
    {
        $this->scenario = 'activity';
        $activity = ($this->Active == self::STATUS_ACTIVE ? self::STATUS_NOACTIVE : self::STATUS_ACTIVE);
        $this->Active = $activity;  //статус = активен / неактивен
        $this->status = $activity;  //поставить активность
        $success = $this->save(false, array('Active', 'status'));
        return $success;
    }
    
    //список заявок на соревнования
    public function getCompetitionList() {
        $sqlCommand = Yii::app()->db->createCommand()
            ->select(array('competition.id', 'competition.name','competition.begindate','competition.enddate'))
            ->from('proposal')
            ->leftJoin('competition', 'proposal.competitionid = competition.id')
            ->where('proposal.userid = :userid')
            ->order('competition.begindate ASC');
        $dataProvider = new CSqlDataProvider($sqlCommand->text, array('params'=>array(':userid'=>$this->UserID,),));
        return $dataProvider;
    }    
}
