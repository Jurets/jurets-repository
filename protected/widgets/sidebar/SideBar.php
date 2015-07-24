<?php
class SideBar extends CWidget {
    
    public $view = 'sidebarleft'; // имя  вьюшки для рендера
    public $params = array();     // передаваемые параметры
    
    public function init(){
        // здесь может быть некий код для инициализации
    }

    // ------------------------------
    public function run(){
        // здесь может быть некий код ...
        $this->render($this->view, $this->params);
    }
}
