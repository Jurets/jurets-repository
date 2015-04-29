<?php
/* @var $this AgecategoryController */
/* @var $model Agecategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'agecategory-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
	
    <?php echo $form->hiddenField($model, 'CompetitionID'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'AgeName'); ?>
		<?php echo $form->textField($model,'AgeName',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'AgeName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Gender'); ?>
		<?php 
            //echo $form->textField($model,'Gender',array('size'=>1,'maxlength'=>1)); 
            echo $form->DropDownList($model, 'Gender', array('ч' => Yii::t('fullnames', 'male'), 'ж' => Yii::t('fullnames', 'female')), 
                                     array('empty' => '<'.Yii::t('fullnames', 'choose gender').'>'));
        ?>
		<?php echo $form->error($model,'Gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AgeMin'); ?>
		<?php echo $form->textField($model,'AgeMin'); ?>
		<?php echo $form->error($model,'AgeMin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AgeMax'); ?>
		<?php echo $form->textField($model,'AgeMax'); ?>
		<?php echo $form->error($model,'AgeMax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'YearMin'); ?>
		<?php echo $form->textField($model,'YearMin'); ?>
		<?php echo $form->error($model,'YearMin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'YearMax'); ?>
		<?php echo $form->textField($model,'YearMax'); ?>
		<?php echo $form->error($model,'YearMax'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'ordernum'); ?>
        <?php echo $form->textField($model,'ordernum'); ?>
        <?php echo $form->error($model,'ordernum'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('controls', 'Create') : Yii::t('controls', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->