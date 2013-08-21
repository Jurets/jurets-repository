<?php
/* @var $this WeightcategoryController */
/* @var $model Weightcategory */

$this->breadcrumbs=array(
	'Weightcategories'=>array('index'),
	$model->WeightID,
);

$this->menu=array(
	array('label'=>'List Weightcategory', 'url'=>array('index')),
	array('label'=>'Create Weightcategory', 'url'=>array('create')),
	array('label'=>'Update Weightcategory', 'url'=>array('update', 'id'=>$model->WeightID)),
	array('label'=>'Delete Weightcategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->WeightID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Weightcategory', 'url'=>array('admin')),
);
?>

<h1>View Weightcategory #<?php echo $model->WeightID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'WeightID',
		'AgeID',
		'WeightFrom',
		'WeightTo',
		'WeightName',
	),
)); ?>
