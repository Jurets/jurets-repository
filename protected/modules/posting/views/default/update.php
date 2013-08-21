<?php
/* @var $this PostingController */
/* @var $model Posting */

$this->breadcrumbs=array(
	Yii::t('fullnames', 'Postings')=>array('index'),
	//$model->title=>array('view','id'=>$model->post_id),
	Yii::t('controls', ($editMode ? 'Update' : 'Create')),
);

$this->menu=array(
    array('label'=>Yii::t('fullnames', 'List Posting'), 'url'=>array('index')),
    array('label'=>Yii::t('fullnames', 'Create Posting'), 'url'=>array('create')),
	array('label'=>Yii::t('fullnames', 'View Posting'), 'url'=>array('view', 'id'=>$model->post_id)),
    array('label'=>Yii::t('fullnames', 'Delete Posting'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Posting', 'url'=>array('admin')),
);

?>

<h1><?php echo Yii::t('fullnames', ($editMode ? 'Update Posting' : 'Create Posting')) ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>