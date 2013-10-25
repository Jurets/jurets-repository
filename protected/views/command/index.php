<?php
/* @var $this CommandController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Command List'),
);

$this->renderPartial('/site/_delegate');
?>

<h1><?php echo Yii::t('fullnames', 'Command List'); ?></h1>

<?php 
    $this->renderPartial('_index', array('dataProvider'=>$dataProvider));
    
    $this->renderPartial('application.views.competition._stat', array('dataStat'=>$dataStat));
?>