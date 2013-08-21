<?php
/* @var $this WeightcategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Weightcategories',
);

$this->menu=array(
	array('label'=>'Create Weightcategory', 'url'=>array('create')),
	array('label'=>'Manage Weightcategory', 'url'=>array('admin')),
);
?>

<h1>Weightcategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
