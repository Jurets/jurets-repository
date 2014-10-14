<?php

class ParticipantController extends Controller 
{
    //получить команду (по текущему юзеру)
    protected function getUserCommand() {
        $commandid = Yii::app()->user->commandid;
        if (isset($commandid) && !empty($commandid))
            return Command::model()->findByPk($commandid);
    }

    //проверка: текущий юзер - совпадает ли с заданным юзером (по ИД)
    protected function isUserOwner($uid, $model) {
        return ($uid == $model->UserID);
    }
  
}
?>
