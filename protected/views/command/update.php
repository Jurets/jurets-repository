<?php
/* @var $this CommandController */
/* @var $model Command */

$this->breadcrumbs=array(
	'Команды'=>array('index'),
	$model->CommandName=>array('view','id'=>$model->CommandID),
	'Редактировать',
);

//$this->menu=array(
    //array('label'=>'Список команд', 'url'=>array('command/index')),
    //array('label'=>'Добавить спортсмена', 'url'=>array('create'), 'visible'=>!Yii::app()->user->isGuest),
	//array('label'=>'Создать команду', 'url'=>array('create'), 'visible'=>!Yii::app()->user->isGuest),
	//array('label'=>'Просмотр команды', 'url'=>array('view', 'id'=>$model->CommandID)),
	//array('label'=>'Manage Command', 'url'=>array('admin')),
//);
?>

<h1>Редактировать команду <?php echo $model->CommandName; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>