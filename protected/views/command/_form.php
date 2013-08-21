<?php
/* @var $this CommandController */
/* @var $model Command */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'command-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля, помеченные звёздочкой <span class="required">*</span> являются обязательными для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'CommandName'); ?>
        <?php echo $form->textField($model,'CommandName',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'CommandName'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->