<?php
if (!isset($columns))
    $columns = array(
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
);
$columns[] = array(
    'class'=>'bootstrap.widgets.TbButtonColumn',
    'template'=>'{update}',
    'buttons'=>array (
        'update' => array (
            'label'=>Yii::t('controls', 'Update'),
            'url'=>'Yii::app()->createUrl("sportsmen/update", array("id"=>$data["SpID"]))',
        ),
    ),
);

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'weigthlist_'.$weigthid,
    'dataProvider'=>$dataProvider,
    //'filter'=>$model,
    'template'=>"{pager}<br>{items}<br>{pager}",
    'type'=>'striped bordered condensed',
    'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),
    'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    'columns'=>$columns, 
));