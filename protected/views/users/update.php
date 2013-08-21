<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	Yii::t('fullnames', 'Users')=>array('index'),
	$model->UserID=>array('view','id'=>$model->UserID),
	Yii::t('controls', 'Update'),
);

$this->renderPartial('_menu', array('model'=>$model));
/*$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->UserID)),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);*/
?>

<h1><?php echo Yii::t('controls', 'Update').': '.Yii::t('fullnames', 'user'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>