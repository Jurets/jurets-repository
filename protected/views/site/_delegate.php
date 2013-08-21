<?php
$this->menu=array(
    array('label'=>Yii::t('controls', 'Operations')),
    array('label'=>Yii::t('fullnames', 'Competition'), 'url'=>array('/competition/view'), 'icon'=>'cog'),
    //array('label'=>'Заявки', 'url'=>array('/proposal/index')),
    array('label'=>Yii::t('fullnames', 'Commands'), 'url'=>array('/command/index'), 'icon'=>'flag'),
    array('label'=>Yii::t('fullnames', 'Sportsmens'), 'url'=>array('/sportsmen/index'), 'icon'=>'user'),
    array('label'=>Yii::t('fullnames', 'Coaches'), 'url'=>array('/coach/index'), 'icon'=>'user'),
);
?>