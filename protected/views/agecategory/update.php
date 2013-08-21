<?php
/* @var $this AgecategoryController */
/* @var $model Agecategory */

$this->breadcrumbs=array(
	'Agecategories'=>array('index'),
	$model->AgeID=>array('view','id'=>$model->AgeID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Agecategory', 'url'=>array('index')),
	array('label'=>'Create Agecategory', 'url'=>array('create')),
	array('label'=>'View Agecategory', 'url'=>array('view', 'id'=>$model->AgeID)),
	array('label'=>'Manage Agecategory', 'url'=>array('admin')),
);
?>

<h1>Update Agecategory <?php echo $model->AgeID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>