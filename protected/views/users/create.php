<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	//'Users'=>array('index'),
	'Регистрация',
);

/*$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);*/
?>

<h1><?php echo Yii::t('controls', 'Registration').': '.Yii::t('fullnames', 'user'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>