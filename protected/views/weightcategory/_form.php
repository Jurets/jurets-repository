<?php
/* @var $this WeightcategoryController */
/* @var $model Weightcategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'weightcategory-form',
	'enableAjaxValidation'=>false,
    'action'=>$this->createUrl('/weightcategory/create', array('id'=>$age->AgeID))
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model, 'AgeID'); ?>
    
	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'AgeID'); ?>
		<?php echo $form->textField($model,'AgeID'); ?>
		<?php echo $form->error($model,'AgeID');*/ ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'WeightFrom'); ?>
		<?php echo $form->textField($model,'WeightFrom'); ?>
		<?php echo $form->error($model,'WeightFrom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WeightTo'); ?>
		<?php echo $form->textField($model,'WeightTo'); ?>
		<?php echo $form->error($model,'WeightTo'); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'WeightName'); ?>
		<?php echo $form->textField($model,'WeightName',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'WeightName');*/ ?>
	</div>-->
    
    <div class="row">
        <?php echo $form->labelEx($model,'ordernum'); ?>
        <?php echo $form->textField($model,'ordernum'); ?>
        <?php echo $form->error($model,'ordernum'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->