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

<h1><?php echo $age->AgeName; ?> - весовые категории</h1>

<?php 

if (Yii::app()->user->isExtendRole()) {
    /*echo CHtml::tag('a', array(
        'href'=>Yii::app()->createUrl('/competition/update'),
        'class'=>'btn btn-primary',
        'title'=>Yii::t('fullnames', 'Изменить параметры соревнования')
    ), Yii::t('controls','Update'));
 
    //эксопрт в CSV
    echo CHtml::tag('a', array(
        'href'=>Yii::app()->createUrl('/competition/exportcsv'),
        'class'=>'btn btn-primary',
        'title'=>Yii::t('fullnames', 'Экспорт данных в CSV-файл'),
        'style'=>'margin-left: 20px;'
    ), Yii::t('controls','Экспорт')); */
    
    $actions = CHtml::tag('a', array(
        'href'=>Yii::app()->createUrl('/weightcategory/create', array('id'=>$age->AgeID)),
        'class'=>'btn btn-primary',
        'title'=>Yii::t('fullnames', 'Добавить'),
        'style'=>'margin-top: 20px; margin-bottom: 20px;'
    ), Yii::t('controls','Create'));
} else {
    $actions = '';
}

//echo $actions;

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); 

echo $actions;

   
?>
