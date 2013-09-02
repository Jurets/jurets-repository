<?php 
/*if (Yii::app()->user->isExtendRole()) 
{
    $urlview = 'Yii::app()->createUrl("proposal/confirm", array("id"=>$data["propid"]))';
}
else
{*/
    $urlview = 'Yii::app()->createUrl("proposal/view", array("id"=>$data["propid"]))';
//}
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'proposal-grid',
    'dataProvider'=>$dataProvider,
    'template'=>"{pager}<br>{items}<br>{pager}",
    'type'=>'striped bordered condensed',
    'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),
    'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    'selectableRows'=>0,
    'columns'=>array(
        array(
            'header'=>'Команда',
            'type'=>'html',
            'value'=>'CHtml::link(CHtml::encode($data->relCommand->CommandName), '.$urlview.')', //'CHtml::normalizeUrl(array("proposal/confirm", "id"=>$data[propid])))',
        ),
        'country',
        'city',
        'federation',
        'club',
        //'status',
        'participantcount',
        array(
            'header'=>'Подтв.',
            'class'=>'ext.ECheckBoxColumn',
            'id'=>'Proposal_id',
            'checked'=>'$data->status == 1',
            'disabled'=>'true', //(true/false exression (same as rowCssClassExpression)
        ),
        /*array(
            'class'=>'CButtonColumn',
            'template'=>'{view}',
            'buttons'=>array (
                'view' => array (
                    'label'=>'Просмотреть',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
                    'url'=>$urlview,//'Yii::app()->createUrl("proposal/view", array("id"=>$data[propid]))',
                    ),
            ),
        ), */
    ),
)); ?>
