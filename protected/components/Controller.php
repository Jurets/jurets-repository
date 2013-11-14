<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    //внутр переменная (для единоразовой выборки модели)
    protected $_competition;
    
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    //подсказка вверху в бредкрамбсах справа
    public $popTopHelp = array();

    /**
    * Путь для соревнования (для формирования url)
    * 
    * @var mixed
    */
    public $pathCompetition = '';
    
    /**
    * событие перед действием контроллеров:
    * - выбрать алиас для соревнования
    * 
    * @param mixed $action
    * @return boolean
    */
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {//DebugBreak();
            $path = Yii::app()->request->getParam('path');
            $this->pathCompetition = !empty($path) ? $path : '';
            return true;
        } else {
            return false;
        }
    }
    
  //вернуть модель Соревнование (ИД берётся пока что из хардкода)
    public function getCompetition($id = null)
    {
        if (!isset($this->_competition)) {
            if (empty($id))
                $id = Yii::app()->competitionId;
            $this->_competition = Competition::model()->findByPk($id);
            if($this->_competition === null)
                throw new CHttpException(404,'Запрашиваемая страница не найдена. Сообщите об ошибке организаторам соревнований');
        }
        return $this->_competition;
    }
   
    //СТАТ: узнать ограничение по кол-ву спортсменов
    public function checkIsFiling() {
        //$isfilling = self::getCompetitionParam('isfiling');
        $competition = $this->getCompetition();
        $isfilling = $competition->isfiling;
        if (!$isfilling)
            throw new CHttpException(410, 'Запрещен ввод информации! На данный момент регистрация участников запрещена. '.
            'При необходимости свяжитесь с организаторами соревнований');
    }
    
}