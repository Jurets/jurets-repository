<?php
$this->breadcrumbs=array(
	'Judges'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Judge','url'=>array('index')),
	array('label'=>'Create Judge','url'=>array('create')),
	array('label'=>'Update Judge','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Judge','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Judge','url'=>array('admin')),
);
?>

<h1>View Judge #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userid',
		'category',
		'level',
		'competitionid',
		'commandid',
		'status',
		'created',
	),
)); ?>
