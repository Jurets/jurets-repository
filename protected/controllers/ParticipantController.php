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

    protected function getYears() {
        $_cacheID = 'cacheAgeYearPeriod';
        //Yii::app()->cache->delete($_cacheID);     //удаление из кэша
        $row = Yii::app()->cache->get($_cacheID);   //проверить кэш
        if ($row === false) {
            // устанавливаем значение $value заново, т.к. оно не найдено в кэше,
            $row = Yii::app()->db->createCommand('SELECT MIN(YearMin) AS YearMin, MAX(YearMax) AS YearMax FROM agecategory')->queryRow();
            // и сохраняем его в кэше для дальнейшего использования:
            Yii::app()->cache->set($_cacheID, $row, 28800);  //8 часов
        }
        $ymin = $row['YearMin'];
        $ymax = $row['YearMax'];

        $years = array();
        for ($year = $ymax; $year >= $ymin; $year--)
            $years[$year.'-01-01'] = $year;            //ВРЕМЕННО!!!! -------- надо будет переделать
        return $years;
    }
  
}
?>
