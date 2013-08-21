<?php
/* @var $this AgecategoryController */
/* @var $model Agecategory */

$this->breadcrumbs=array(
	'Agecategories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Agecategory', 'url'=>array('index')),
	array('label'=>'Manage Agecategory', 'url'=>array('admin')),
);
?>

<h1>Create Agecategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>