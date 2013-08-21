<?php
/* @var $this AgecategoryController */
/* @var $model Agecategory */

$this->breadcrumbs=array(
	Yii::t('fullnames', 'Agecategories')=>array('index'),
	$model->AgeName,
);

$this->menu=array(
	array('label'=>Yii::t('controls', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('controls', 'Create'), 'url'=>array('create')),
	array('label'=>Yii::t('controls', 'Update'), 'url'=>array('update', 'id'=>$model->AgeID)),
	array('label'=>Yii::t('controls', 'Delete'), 'url'=>array('#'), 
        'linkOptions'=>array('submit'=>array('delete','id'=>$model->AgeID),'confirm'=>Yii::t('controls', 'Are you sure you want to delete this item').'?')),
	//array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>View Agecategory #<?php echo $model->AgeID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'AgeID',
		'AgeName',
		'Gender',
		'AgeMin',
		'AgeMax',
		'YearMin',
		'YearMax',
	),
)); ?>
