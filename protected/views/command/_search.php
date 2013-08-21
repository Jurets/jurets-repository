<?php
/* @var $this CommandController */
/* @var $model Command */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CommandID'); ?>
		<?php echo $form->textField($model,'CommandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CommandName'); ?>
		<?php echo $form->textField($model,'CommandName',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->