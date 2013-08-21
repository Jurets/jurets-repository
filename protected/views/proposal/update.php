<?php
/* @var $this ProposalController */
/* @var $model Proposal */

$this->breadcrumbs=array(
	'Proposals'=>array('index'),
	$model->propid=>array('view','id'=>$model->propid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Proposal', 'url'=>array('index')),
	array('label'=>'Create Proposal', 'url'=>array('create')),
	array('label'=>'View Proposal', 'url'=>array('view', 'id'=>$model->propid)),
	array('label'=>'Manage Proposal', 'url'=>array('admin')),
);
?>

<h1>Update Proposal <?php echo $model->propid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>