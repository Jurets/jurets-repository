<?php
/* @var $this CoachController */
/* @var $model Coach */

$this->breadcrumbs = $crumbs
/*array(
	'Тренеры'=>array('index'),
	$model->CoachName=>array('view','id'=>$model->CoachID),
	'Редактировать',
)*/;

//$this->menu=array(
	//array('label'=>'Create Coach', 'url'=>array('create')),
//	array('label'=>'Просмотр тренера', 'url'=>array('view', 'id'=>$model->CoachID)),
//    array('label'=>'Список команд', 'url'=>array('command/index')),
//    array('label'=>'Спортсмены', 'url'=>array('/sportsmen/index')),
//    array('label'=>'Тренеры', 'url'=>array('/coach/index')),
//);
?>

<h1>Редактировать данные тренера #<?php echo $model->CoachID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>