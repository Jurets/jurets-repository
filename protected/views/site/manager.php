<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Competition Manager') => array('competition/manager'),
);

//компонент показа всплывающих сообщений (Алерт)  
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true/*, 'closeText'=>'&times;'*/), // success, info, warning, error or danger
        'error'=>array('block'=>true, 'fade'=>true), 
        'warning'=>array('block'=>true, 'fade'=>true), 
    ),
));


?>

<?php

$this->menu=array(
    array('label'=>Yii::t('fullnames', 'Competition'), 
        'url'=>array($this->pathCompetition . '/competition/view'), 
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
        'url'=>array($this->pathCompetition . '/command/manage'), 
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