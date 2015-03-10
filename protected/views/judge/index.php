<?php
$this->breadcrumbs=array(
	'Judges',
);

$this->menu=array(
	array('label'=>'Create Judge','url'=>array('create')),
	array('label'=>'Manage Judge','url'=>array('admin')),
);
?>

<h1>Judges</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
