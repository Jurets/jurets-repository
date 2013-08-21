<?php
/* @var $this CompetitionController */
/* @var $model Competition */

$this->breadcrumbs=array(
	$model->name,
);

//шаблон для соревнования
$this->renderPartial('/site/_delegate');

?>

<h1><?php echo Yii::t('controls', 'View').': '.Yii::t('fullnames', 'Competition'); ?></h1>

<?php

$this->renderPartial('_view', array('model'=>$model));
$this->renderPartial('_stat', array('dataStat'=>$dataStat));

?>
