<?php
/* @var $this CommandController */
/* @var $model Command */

$this->breadcrumbs=array(
    'Команды'=>array('index'),
    'Создать',
);

$this->menu=array(
    array('label'=>'Список команд', 'url'=>array('index')),
    array('label'=>'Фильтр / Поиск', 'url'=>array('admin')),
);
?>

<h1>Создать команду</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>