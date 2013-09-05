<?php
  class WebUser extends CWebUser {
    private $_model = null;
    private $_proposalid = null;
    //private $_id;
    //public $commandid;    
    //private $_commandid;
    
    /*function get_id() {
        return $this->_id;
    }

    function get_roleid() {
        return $this->_roleid;
    }*/

  //процедура после логина: установить переменные сесси для юзера 
    protected function afterLogin($fromCookie) {
        if($user = $this->getModel()){
            $this->setState('currentUserID', $user->UserID);
            $this->setState('currentUserStatus', $user->Active);
            $this->setState('currentUserRole', $user->RoleID);
        }
    }

    /*protected function afterLogout() {
        $this->setState('currentUserID', 0, 0);
        $this->setState('currentUserActive', 0, 0);
    }*/
    
    public function getProposalid() {
        $proposal = Proposal::model()->find('login = :login', array(':login'=>Yii::app()->user->name));
        if (isset($proposal) && !empty($proposal)) {
            $propid = $proposal->propid;
            return $propid;
        }
    }

  //вернуть ИД команды текущего юзера  
    function getCommandid() {
        if ($this->isGuest || $this->isExtendRole())
            return null;
        else {
            if ($commandid = $this->getState('userCommandID'))  //проверить - сохранён ли ИД в сессии
                return $commandid;                              //если да - вернуть его
            if ($userid = $this->userid){                        //иначе - вернуть ИД из базы
                $cmd = Yii::app()->db->createCommand('SELECT commandid FROM proposal WHERE competitionid= :competitionid AND userid = :userid');
                $cmd->bindParam('userid', $userid, PDO::PARAM_INT);
                $compid = Yii::app()->competitionId;
                $cmd->bindParam('competitionid', $compid, PDO::PARAM_INT);
                $commandid = $cmd->queryScalar();
                $this->setState('userCommandID', $commandid); //и установить в сессию
                return $commandid;
            }
        }
    }

  //вернуть ИД текущего юзера  
    function getUserid() {
        if ($curruserid = $this->getState('currentUserID'))  //проверить - сохранён ли ИД в сессии
            return $curruserid;                              //если да - вернуть его
        else if($user = $this->getModel()){                  //иначе - вернуть ИД из базы
            $this->setState('currentUserID', $user->UserID); //и установить в сессию
            return $user->UserID; // в таблице User есть поле role_id
        }
    }
    
    function getIsUserActive() {
        if (Yii::app()->user->isGuest)
            return false;
        else if ($useractive = $this->getState('currentUserStatus'))
            return $useractive;
        else if ($user = $this->getModel()){                  //иначе - вернуть ИД из базы
            $this->setState('currentUserStatus', $user->status); //и установить в сессию
            return ($user->status == Users::STATUS_ACTIVE); // в таблице User есть поле role_id
        }
    }

    function getRole() {
        if ($userrole = $this->getState('currentUserRole'))
            return $userrole;
        else if($user = $this->getModel()){
            $this->setState('currentUserRole', $user->RoleID); //и установить в сессию
            return $user->RoleID; // в таблице User есть поле role_id
        }
    }
 
    public function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $criteria = new CDbCriteria;
            $criteria->select = '*';  // выбираем только поле 'title'
            $criteria->condition = 'UserName = :UserName';
            $criteria->params = array(':UserName'=>Yii::app()->user->name);
            $this->_model = Users::model()->find($criteria);
            //$this->_model = User::model()->findByPk(Yii::app()->user->get_id()/*, array('select' => 'roleid')*/);
        }
        return $this->_model;
    }
    
    //проверка: текущая роль - админ или менеджер
    public function isExtendRole() {
        $role = strtolower(Yii::app()->user->role);
        return ($role == 'admin' || $role == 'manager');
    }

    //проверка: текущая роль - менеджер
    public function isManagerRole() {
        return (strtolower(Yii::app()->user->role) == 'manager');
    }
    
    //проверка: текущая роль - менеджер
    public function isAdminRole() {
        return (strtolower(Yii::app()->user->role) == 'admin');
    }
}
?>
