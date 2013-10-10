<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$imgpath = Yii::app()->baseUrl.'/images/logo/';
$docpath = Yii::app()->baseUrl.'/document/';

Yii::app()->user->setFlash('info', '<strong>Внимание!</strong> Для того, чтобы подать заявку на соревнование, необходимо выполнить вход или зарегистрироваться, если вы ещё не зарегистрированы!');

$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    ));

//$notCached = $this->beginCache('tkdcard_mainpage', array('duration'=>90));
//if($notCached) 
{ 
    //$competition = Competition::loadModel();    

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'application.views.competition._item',   // refers to the partial view named '_post'
    'tagName'=>'div',
    'itemsTagName'=>'ul',
    'itemsCssClass' => 'media-list'
    /*'sortableAttributes'=>array(
        'title',
        'create_time'=>'Post Time',
    ),*/
));
    

/*$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'proposal-grid',
    'dataProvider'=>$dataProvider,
    'type'=>'striped bordered condensed',
    'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),
    'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    'selectableRows'=>0,
    'columns'=>array(
        array(
            'header'=>'Соревнование',
            'type'=>'html',
            'value'=>'CHtml::link(CHtml::encode($data->title), Yii::app()->createAbsoluteUrl("competition/invite"), array("id"=>$data->id))',
        ),
        'begindate',
        'enddate',
        'place',
    ),
));*/


//$this->endCache(); 
} 
?>