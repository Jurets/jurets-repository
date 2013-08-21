<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    private $_id;
    private $_roleid;    
    private $_commandid;
    

    public function get_roleid() {
        return $this->_roleid;
    }

    public function get_commandid() {
        return $this->_commandid;
    }
    public function get_id() {
        return $this->_id;
    }
    
	public function authenticate()
	{
        $username = strtolower($this->username);
        $user = Users::model();
        $result = $user->find('LOWER(UserName) = ?', array($username));
        if (!isset($result))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if(!$result->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $result->UserID;
            $this->_commandid = $result->CommandID;
            $this->username = $result->UserName;             //установить имя юзера
            /*$proposal = Proposal::model()->find('login = :login', array(':login'=>$this->username));
            if (isset($proposal) && !empty($proposal)) {
                $propid = $proposal->propid;
                Yii::app()->user->setProposalid($propid);
            }*/
            $this->errorCode = self::ERROR_NONE;             //нет ошибки
        }
        return !$this->errorCode;
	}
}
