<?php
/* @var $this PostingController */
/* @var $model Posting */

//подключить скрипт для слайдера фотогалереи
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl(true).'/javascript/common.js');

$this->breadcrumbs=array(
	Yii::t('fullnames', 'Postings')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('fullnames', 'List Posting'), 'url'=>array('index')),
	array('label'=>Yii::t('fullnames', 'Create Posting'), 'url'=>array('create')),
	array('label'=>Yii::t('fullnames', 'Update Posting'), 'url'=>array('update', 'id'=>$model->post_id)),
	array('label'=>'Добавить из VKontakte', 'url'=>array('getalbums')),
    array('label'=>Yii::t('fullnames', 'Delete Posting'), 'url'=>'#', 
        'linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),
        'confirm'=>Yii::t('fullnames', 'Are you sure you want to delete this item?'))
    ),
	//array('label'=>'Manage Posting', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('fullnames', 'Posting Info')/*.' '.$model->title;*/ ?></h1>

<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'meta_description',
		'post_type',
		'date_create',
		'num_comments',
		't_photo_id',
		'teaser',
		'is_active',
		'like_count',
		'informer_title',
		'show_gallery',
        'post_id',
	),
)); 

echo CHtml::tag('hr');
echo CHtml::link('Просмотреть фотогалерею', '#', 
    array('onclick'=>'popUp("'.Yii::app()->createAbsoluteUrl('posting/default/show', array('id'=>$model->post_id)).'");return false')
);
?>
