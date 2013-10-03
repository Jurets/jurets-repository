<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$imgpath = Yii::app()->baseUrl.'/images/logo/';
$docpath = Yii::app()->baseUrl.'/document/';
?>

<?php 

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
