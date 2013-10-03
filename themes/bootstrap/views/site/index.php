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
    'sortableAttributes'=>array(
        'title',
        'create_time'=>'Post Time',
    ),
    'tagName'=>'div',
    'itemsTagName' => 'ul',
    'itemsCssClass' => 'media-list',
));


    
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'proposal-grid',
    'dataProvider'=>$dataProvider,
    //'template'=>"{pager}<br>{items}<br>{pager}",
    'type'=>'striped bordered condensed',
    'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),
    'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    'selectableRows'=>0,
    'columns'=>array(
        //'name',
        array(
            'header'=>'Команда',
            'type'=>'html',
            'value'=>'CHtml::link(CHtml::encode($data->title), $data->id)',
        ),
        //'title',
        'begindate',
        'enddate',
        'place',
    ),
));


//$this->endCache(); 
} 
?>

<!--<ul class="media-list">
  <li class="media">
    <a class="pull-left" href="#">
      <img class="media-object" src="/images/tkd_57x60.png" alt="...">
    </a>
    <div class="media-body">
      <h4 class="media-heading">Media heading</h4>
      ...
    </div>
  </li>
</ul>-->
