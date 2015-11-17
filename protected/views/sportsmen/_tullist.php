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
            'header'=>'Лет',
            'name'=>'fullyears',
        ), 
        array(
            'header'=>'Куп',
            'name'=>'AttestLevel',
        ), 
        array(
            'header'=>'Тренер',
            'name'=>'Coachname',
        ), 
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}', //'{view}{update}{delete}',
            'buttons'=>array (
                'update' => array (
                    'label'=>Yii::t('controls', 'Update'),
                    'url'=>'Yii::app()->createUrl("sportsmen/update", array("id"=>$data["SpID"]))',
                    'options'=>array('target'=>'_blank'),
                ),
            ),
        ),
);

//echo CHtml::tag('h4', array(), 'Весовая категория - ', true);

/*if ($isCache) {
    $_cacheID = 'cacheWeigthList_'.$weigthid;
    $notCached = $this->beginCache($_cacheID, array('duration'=>60));
} else
   $notCached = true;
   
if ($notCached)*/ { 
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

    /*if ($isCache)
        $this->endCache();*/
}
    
?>
