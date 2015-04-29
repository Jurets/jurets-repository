<?php
/* @var $this AgecategoryController */
/* @var $model Agecategory */

$this->breadcrumbs=array(
	'Weightcategories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Agecategory', 'url'=>array('index')),
	array('label'=>'Manage Agecategory', 'url'=>array('admin')),
);
?>

<h1>Создать весовую категорию</h1>

<?php 
    echo $this->renderPartial('_form', array(
        'age'=>$age,
        'model'=>$model,
    )); 
?>