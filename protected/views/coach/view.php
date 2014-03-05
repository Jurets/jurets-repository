<?php
/* @var $this CoachController */
/* @var $model Coach */

$this->breadcrumbs = $crumbs
/*array(
	'Coaches'=>array('index'),
	$model->CoachID,
)*/;

$this->menu=array(
	//array('label'=>'List Coach', 'url'=>array('index')),
	//array('label'=>'Добавить тренера', 'url'=>array('create')),
	array('label'=>Yii::t('controls', 'Edit'), 'url'=>array('update', 'id'=>$model->CoachID)),
	array('label'=>Yii::t('controls', 'Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CoachID),'confirm'=>'Вы действительно хотите удалить тренера?')),
	//array('label'=>'Фильтр / Поиск', 'url'=>array('admin')),
    //array('label'=>'Список команд', 'url'=>array('command/index')),
    //array('label'=>'Спортсмены', 'url'=>array('/sportsmen/index')),
    //array('label'=>'Тренеры', 'url'=>array('/coach/index')),
);
?>

<h1>
<?php echo Yii::t('controls', 'View').': '
		.Yii::t('fullnames', 'Coach').'<br/>'
		.$model->CoachName;
?>
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CoachName',
		//'CommandID',
		array(
            'label'=>'Команда',
            'value'=>$model->Command->CommandName,
        ),
        'CoachID',
	),
)); ?>
