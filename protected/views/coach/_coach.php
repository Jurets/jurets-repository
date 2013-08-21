<?php
$myCommandID = Yii::app()->user->getCommandid(); //ИД Моей команды
$isMyCommand = !Yii::app()->user->isGuest && ($commandid == $myCommandID);
$isAccess = Yii::app()->user->isExtendRole() || $isMyCommand;

$arrColumns = array(
        array(
            'header'=>Yii::t('fullnames', 'Coach Name'),
            'type'=>'html',
            'value'=>'CHtml::link(CHtml::encode($data[CoachName]), CHtml::normalizeUrl(array("coach/view", "id"=>$data[CoachID])))',
        ));
 
if (!isset($commandid) || empty($commandid))
    $arrColumns[] = array(
            'header'=>Yii::t('fullnames', 'Commandname'),
            'name'=>'Commandname',
        );

$arrColumns = CMap::mergeArray($arrColumns, array(
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=> ($isAccess ? '{view}{update}{delete}' : '{view}'),
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center'),
            'deleteConfirmation'=>'Вы действительно хотите удалить данного тренера? '.$data['CoachName'],
            'buttons'=>array (
                'view' => array (
                    'label'=>Yii::t('controls', 'View'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
                    'url'=>'Yii::app()->createUrl("coach/view", array("id"=>$data[CoachID]))',
                ),
                'update' => array (
                    'label'=>Yii::t('controls', 'Update'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
                    'url'=>'Yii::app()->createUrl("coach/update", array("id"=>$data[CoachID]))',
                ),
                'delete' => array (
                    'label'=>Yii::t('controls', 'Delete'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                    'url'=>'Yii::app()->createUrl("coach/delete", array("id"=>$data[CoachID]))',
                ),
            ),
        ),
));

//$this->widget('zii.widgets.grid.CGridView', array(
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'coach-grid',
    'dataProvider'=>$dataProvider,
    'filter'=>$model,
    'template'=>"{pager}<br>{items}<br>{pager}",
    'type'=>'striped bordered condensed',
    'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),
    'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    'columns'=>$arrColumns, 
));
    
?>