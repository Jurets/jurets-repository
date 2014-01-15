<?php
/**
 * WebApplication.php
 *
 * From Alex Makarov boilerplate
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:44 AM
 */
class WebApplication extends CWebApplication 
{
    private $_defaultCompId = 0;     //ИД соревнования по умолчанию
    private $_competitionId = null;  //ИД запрашиваемого соревнования
    
    public function getCompetitionId() {
        if (empty($this->_competitionId)) {
            $path = Yii::app()->request->getParam('path');
            if (isset($path)) {
                $competition = Competition::getModelPath($path);
                $this->_competitionId = $competition->id;
            }
        }
        
        $id = Yii::app()->params['defaultCompetitionID'];
        $this->_defaultCompId = isset($id) ? $id : $this->_defaultCompId;
        
        return isset($this->_competitionId) ? $this->_competitionId : $this->_defaultCompId;
    }
    
	/**
	 * This function is here because we aren't creating a locale file for every client.
	 * Thus we provide a fallback to "en".
	 */
	public function getLocale($localeID = null) {
		try {
			return parent::getLocale($localeID);
		} catch (Exception $e) {
			return CLocale::getInstance('en');
		}
	}

	/**
	 * We were getting tons of errors in the logs from OPTIONS requests for the URI "*"
	 * As it turns out, the requests were from localhost (::1) and are apparently a way
	 * that Apache polls its processes to see if they're alive. This function causes
	 * Yii to respond without logging errors.
	 */
	public function runController($route) {
		try {
			parent::runController($route);
		} catch (CHttpException $e) {
			if (@$_SERVER['REQUEST_METHOD'] == 'OPTIONS' && @$_SERVER['REQUEST_URI'] == '*') {
				Yii::app()->end('Hello, friend!');
			} else
				throw $e;
		}
	}
    
    public function getUploadImageUrl($fileName)
    {
        if (!is_file($fileName) && !is_file(Yii::app()->params['uploadDir'].DIRECTORY_SEPARATOR.$fileName))
            return Yii::app()->params['defaultPhoto'];
        else
            return Yii::app()->params['uploadLoc'].basename($fileName);
    }
    
    public function getUploadImageDir()
    {
        
        return Yii::app()->params['uploadDir'];
    }
    
    public function getUploadImageLoc()
    {
        return Yii::app()->params['uploadLoc'];
    }

    //вернуть ИД текущего юзера
    function getUserid() {
        return $this->user->userid;
    }
    
    //активен ли текущий юзер
    function getIsUserActive() {
        return $this->user->isUserActive;
    }
    
    //проверка: текущая роль - админ или менеджер
    function getIsExtendRole() {
        return $this->user->isExtendRole();
    }

    //проверка: текущая роль - менеджер
    public function getIsManager() {
        return $this->user->isManagerRole();
    }
    
    //проверка: текущая роль - менеджер
    public function getIsAdmin() {
        return $this->user->isAdminRole();
    }

    //проверка: текущая юзер - гость
    public function getIsGuestUser() {
        return $this->user->isGuest;
    }
    
    //include('application.');
/**
 * Функция для перевода даты на русский язык
 *
 * @param number дата в unix формате
 * @param string формат выводимой даты
 * @param number сдвиг времени (часов, относительно времени на сервере)
 * 
 * %MONTH% — русское название месяца (родительный падеж)
 * %DAYWEEK% — русское название дня недели
 *
 * @example 
 * echo dateToRus( time(), '%DAYWEEK%, j %MONTH% Y, G:i' );
 * 
 * суббота, 10 декабря 2010, 12:03
 */
public function dateToRus($d, $format = 'j %MONTH% Y', $offset = 0)
{
    $months = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля',
                    'августа', 'сентября', 'октября', 'ноября', 'декабря');
    $days = array('понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье');
    $d += 3600 * $offset;
    $format = preg_replace(array(
        '/%MONTH%/i',
        '/%DAYWEEK%/i'
    ), array(
        $months[date("m", $d) - 1],
        $days[date("N", $d) - 1]
    ), $format);
    return date($format, $d);
} 

public function dateToUkr($d, $format = 'j %MONTH% Y', $offset = 0)
{
    $months = array('січня', 'лютого', 'березня', 'квітня', 'травня', 'червня', 'липня',
                    'серпня', 'вересня', 'жовтня', 'листопада', 'грудня');
    $days = array('понеділок', 'вівторок', 'середа', 'четвер', 'п`ятница', 'субота', 'неділя');
    $d += 3600 * $offset;
    $format = preg_replace(array(
        '/%MONTH%/i',
        '/%DAYWEEK%/i'
    ), array(
        $months[date("m", $d) - 1],
        $days[date("N", $d) - 1]
    ), $format);
    return date($format, $d);
}  

public function beforeControllerAction($controller, $action) {
    $msg = "\n\r=======================". date('Y.m.d H:i:s'/*, time()*/) ."\n\r";
    Yii::log($msg, 'info', 'application'/*'system.web.CController'*/);
    return true;
}

public function afterControllerAction($controller, $action) {
    $stats = Yii::app()->db->getStats();  
    //Yii::trace($message, $category);
    //Yii::log($controller->name.'.'.$action->name.' --- Количество запросов SQL: '.$stats[0].' Длительность: '.$stats[1], 'info', 'application'/*'system.web.CController'*/);   
    //$msg = "\n\r=======================". date('Y.m.d H:m:s') time()."\n\r".
    //       Yii::app()->request->url.' --- Количество запросов SQL: '.$stats[0].' Длительность: '.$stats[1].
    //       "\n\r======================="

    $msg = Yii::app()->request->url.' --- Количество запросов SQL: '.$stats[0].' Длительность: '.$stats[1].
           "\n\r=======================". date('Y.m.d H:i:s'/*, time()*/) ."\n\r";
    Yii::log($msg, 'info', 'application'/*'system.web.CController'*/);
    //Yii::trace('Количество запросов SQL: '.$stats[0].' Длительность: '.$stats[1], 'system.web.CController');
}

    
}
