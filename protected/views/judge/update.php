<?php
$this->breadcrumbs=array(
	'Judges'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Judge','url'=>array('index')),
	array('label'=>'Create Judge','url'=>array('create')),
	array('label'=>'View Judge','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Judge','url'=>array('admin')),
);
?>

<h1>Update Judge <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>