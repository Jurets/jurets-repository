<?php
/* @var $this CoachController */
/* @var $model Coach */

$this->breadcrumbs=$crumbs
/*array(
	'Тренеры'=>array('index'),
	'Создать',
)*/;

/*$this->menu=array(
	array('label'=>'Список тренеров', 'url'=>array('index')),
	array('label'=>'Фильтр / поиск', 'url'=>array('admin')),
);*/
?>

<h1>Добавить тренера</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>