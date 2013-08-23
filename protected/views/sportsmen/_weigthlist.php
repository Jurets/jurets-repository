<?php

$arrColumns = array(
        array(
            'header'=>'Фамилия, Имя',
            //'value'=>$data->FullName,
            //'type'=>'html',
            //'value'=>'CHtml::link(CHtml::encode($data[FullName]), CHtml::normalizeUrl(array("sportsmen/view", "id"=>$data[SpID])))',
            'name'=>'FullName',
        ),
        array(
            'header'=>'Команда',
            'name'=>'Commandname',
        ),
        array(
            'header'=>'ФСТ',
            'name'=>'FstName',
            //'value'=>$data->FstName  
        ),
        array(
            'header'=>'Год рожд',
            'name'=>'BirthYear',
        ), 
        array(
            'header'=>'Разряд',
            'name'=>'CategoryName',
        ), 
        array(
            'header'=>'Тренер',
            'name'=>'Coachname',
        ), 
        /*array(
            'header'=>'Первый тренер',
            'name'=>'Coachname1',
        ),*/ 
//        array(
//            'class'=>'CButtonColumn',
//            'template'=>'{view}{update}{delete}',
//            'deleteConfirmation'=>'Вы действительно хотите удалить данного спортсмена? '.$data['LastName'],
//            'buttons'=>array (
//                'view' => array (
//                    'label'=>'Просмотреть',
//                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
//                    'url'=>'Yii::app()->createUrl("sportsmen/view", array("id"=>$data[SpID]))',
//                    ),
//                'update' => array (
//                    'label'=>'Изменить',
//                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
//                    'url'=>'Yii::app()->createUrl("sportsmen/update", array("id"=>$data[SpID]))',
//                    ),
//                'delete' => array (
//                    'label'=>'Удалить',
//                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
//                    'url'=>'Yii::app()->createUrl("sportsmen/delete", array("id"=>$data[SpID]))',
//                    ),
//            ),
//        ),
);

/*    array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CommandID),
        'confirm'=>'Вы действительно хотите удалить команду?'), 'visible'=>!Yii::app()->user->isGuest),
*/

//echo CHtml::tag('h4', array(), 'Весовая категория - ', true);

if ($isCache) {
    $_cacheID = 'cacheWeigthList_'.$weigthid;
    $notCached = $this->beginCache($_cacheID, array('duration'=>60));
} else
   $notCached = true;
   
if ($notCached) { 
//if($this->beginCache($wcache, array('duration'=>3600))) {
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'sportsmen-grid',
        'dataProvider'=>$dataProvider,
        //'filter'=>$model,
        //'cssFile'=>null,
        'template'=>"{pager}<br>{items}<br>{pager}",
        'type'=>'striped bordered condensed',
        'htmlOptions' => array(
            'class' => 'table-list',
            'style' => 'font-size: 12px;'),
        'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
        'columns'=>$arrColumns, 
    ));

    if ($isCache)
        $this->endCache();
}
    
?>
