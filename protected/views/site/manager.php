<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Competition Manager')
);
?>

<?php

$this->menu=array(
    array('label'=>Yii::t('fullnames', 'Competition'), 'url'=>array('/competition/manage')),
    array('label'=>Yii::t('fullnames', 'Categories'), 'url'=>array('/agecategory/index')),
    array('label'=>Yii::t('fullnames', 'Proposals'), 'url'=>array('/proposal/manage')),
);
?>