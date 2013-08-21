<?php
/* @var $this WeightcategoryController */
/* @var $model Weightcategory */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'WeightID'); ?>
		<?php echo $form->textField($model,'WeightID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AgeID'); ?>
		<?php echo $form->textField($model,'AgeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WeightFrom'); ?>
		<?php echo $form->textField($model,'WeightFrom'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WeightTo'); ?>
		<?php echo $form->textField($model,'WeightTo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WeightName'); ?>
		<?php echo $form->textField($model,'WeightName',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->