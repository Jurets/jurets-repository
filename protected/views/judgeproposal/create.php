<?php
/* @var $this ProposalController */
/* @var $model Proposal */

$this->breadcrumbs=array(
	//'Предварительные заявки'=>array('index'),
	Yii::t('fullnames', 'Proposal'),
);

/*$this->menu=array(
	array('label'=>'List Proposal', 'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess('manager')),
	array('label'=>'Manage Proposal', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('manager')),
);*/
?>

<h1><?php echo Yii::t('fullnames', 'Competition').': './*Yii::t('controls', 'Create').*/Yii::t('fullnames', 'Judge Proposal'); ?></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>