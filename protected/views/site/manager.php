<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Competition Manager')
);
?>

<?php

$this->menu=array(
    array('label'=>Yii::t('fullnames', 'Competition'), 
        'url'=>array($this->pathCompetition . '/competition/manage'), 
        'icon'=>'cog',
        'linkOptions'=>array(
            'title'=>Yii::t('fullnames', 'Настройки параметров соревнований'), 
        ),
    ),
    array('label'=>Yii::t('fullnames', 'Categories'), 
        'url'=>array($this->pathCompetition . '/agecategory/index'),
        'icon'=>'cog',
        'linkOptions'=>array(
            'title'=>Yii::t('fullnames', 'Настройки категорий'), 
        ),
    ),
    array('label'=>Yii::t('fullnames', 'Proposals'), 
        'url'=>array($this->pathCompetition . '/proposal/manage'),
        'icon'=>'cog',
        'linkOptions'=>array(
            'title'=>Yii::t('fullnames', 'Управление предварительными заявками'), 
        ),
    ),
    '---',
    array('label'=>Yii::t('fullnames', 'Commands'), 
        'url'=>array($this->pathCompetition . '/command/index'), 
        'icon'=>'flag',
        'linkOptions'=>array(
            'title'=>Yii::t('fullnames', 'Переход к списку команд'), 
        ),
    ),
    array('label'=>Yii::t('fullnames', 'Sportsmens'), 
        'url'=>array($this->pathCompetition . '/sportsmen/index'), 
        'icon'=>'user',
        'linkOptions'=>array(
            'title'=>Yii::t('fullnames', 'Переход к списку спортсменов'), 
        ),
    ),
    array('label'=>Yii::t('fullnames', 'Coaches'), 
        'url'=>array($this->pathCompetition . '/coach/index'), 
        'icon'=>'user',
        'linkOptions'=>array(
            'title'=>Yii::t('fullnames', 'Переход к списку тренеров'), 
        ),
    ),
);
?>