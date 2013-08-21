<?php
/* @var $this PostingController */
/* @var $model Posting */

$this->breadcrumbs=array(
	Yii::t('fullnames', 'Postings')=>array('index'),
	Yii::t('controls', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('fullnames', 'List Posting'), 'url'=>array('index')),
	//array('label'=>'Manage Posting', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('fullnames', 'Create Posting') /*$model->post_id;*/ ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>