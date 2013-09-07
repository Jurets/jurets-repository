<?php
/* @var $this CoachController */
/* @var $model Coach */
/* @var $form CActiveForm */

Yii::app()->getClientScript()->registerCoreScript('jquery');

$isExtendRole = Yii::app()->isExtendRole; 
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'coach-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля, помеченные звёздочкой <span class="required">*</span> являются обязательными для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CommandID'); ?>
        <?php 
            $isDisabled = (!$isExtendRole) && (isset($model->CommandID) && !empty($model->CommandID));
            echo $form->DropDownList($model, 'CommandID', CHtml::listData(Command::model()->findAll(), 'CommandID', 'CommandName'), 
                                    array('empty' => '<Выберите команду>',
                                          'disabled'=>$isDisabled,
                                    )); 
        ?>
		<?php echo $form->error($model,'CommandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CoachName'); ?>
		<?php echo $form->textField($model,'CoachName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'CoachName'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('onclick'=>'$("#Coach_CommandID").attr("disabled", false)')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->