<?php
class FlashMessage extends CWidget {
    
    public $view = 'alert'; // имя  вьюшки для рендера
    private $messages = array();     // передаваемые параметры
    
    public function init() {
        // здесь может быть некий код для инициализации
        $compId = Yii::app()->competitionId;
        $this->messages = Message::model()->findAll('CompetitionID = :id', array(':id'=>$compId));
    }

    // ------------------------------
    public function run(){
        // здесь может быть некий код ...
        $this->render($this->view, array('messages'=>$this->messages));
    }
}
