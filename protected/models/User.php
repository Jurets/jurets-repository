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
 * @property string $UserFIO
 * @property string $PhoneNumber
 * @property string $Email
 * @property integer $Active
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserName, Password, RoleID, Salt', 'required'),
			array('CommandID, Active', 'numerical', 'integerOnly'=>true),
			array('UserName, PhoneNumber', 'length', 'max'=>20),
			array('Password, Salt', 'length', 'max'=>50),
			array('UserFIO, Email', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UserID, UserName, Password, RoleID, Salt, CommandID, UserFIO, PhoneNumber, Email, Active', 'safe', 'on'=>'search'),
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
            'relCommand' => array(self::HAS_ONE, 'Command', 'CommandID'),
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
			'PhoneNumber' => 'Телефон',
			'Email' => 'Email',
			'Active' => 'Акт',
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
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Salt',$this->Salt,true);
		$criteria->compare('CommandID',$this->CommandID);
		$criteria->compare('UserFIO',$this->UserFIO,true);
		$criteria->compare('PhoneNumber',$this->PhoneNumber,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Active',$this->Active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
}