<?php
/* @var $this CoachController */
/* @var $model Coach */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CoachID'); ?>
		<?php echo $form->textField($model,'CoachID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CommandID'); ?>
		<?php echo $form->textField($model,'CommandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CoachName'); ?>
		<?php echo $form->textField($model,'CoachName',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->