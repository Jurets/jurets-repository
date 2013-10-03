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
            'value'=>'CHtml::link(CHtml::encode($data->title), Yii::app()->createAbsoluteUrl("competition/invite"), array("id"=>$data->id))',
        ),
        //'title',
        'begindate',
        'enddate',
        'place',

        
        /*array(
            'header'=>'Подтв.',
            'class'=>'ext.ECheckBoxColumn',
            'id'=>'Proposal_id',
            'checked'=>'$data->status == 1',
            'disabled'=>'true', //(true/false exression (same as rowCssClassExpression)
        ),*/
    ),
));


//$this->endCache(); 
} 
?>
