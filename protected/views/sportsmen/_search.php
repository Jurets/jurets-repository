<?php
/* @var $this SportsmenController */
/* @var $model Sportsmen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'SpID'); ?>
		<?php echo $form->textField($model,'SpID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FirstName'); ?>
		<?php echo $form->textField($model,'FirstName',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MiddleName'); ?>
		<?php echo $form->textField($model,'MiddleName',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BirthDate'); ?>
		<?php echo $form->textField($model,'BirthDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Gender'); ?>
		<?php echo $form->textField($model,'Gender',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CommandID'); ?>
		<?php echo $form->textField($model,'CommandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FstID'); ?>
		<?php echo $form->textField($model,'FstID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CategoryID'); ?>
		<?php echo $form->textField($model,'CategoryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AttestLevelID'); ?>
		<?php echo $form->textField($model,'AttestLevelID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WeigthID'); ?>
		<?php echo $form->textField($model,'WeigthID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Coach1ID'); ?>
		<?php echo $form->textField($model,'Coach1ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Coach2ID'); ?>
		<?php echo $form->textField($model,'Coach2ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MedicSolve'); ?>
		<?php echo $form->textField($model,'MedicSolve'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->