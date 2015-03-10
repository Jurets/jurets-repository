<?php
/* @var $this JudgeController */
/* @var $model Judge */
/* @var $form TbActiveForm */
?> 

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'judge-form',
	'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'well'),
)); ?>

    <p class="note"><?=Yii::t('fullnames', 'Fields with {asteriks} are required.', array('{asteriks}'=>'<span class="required">*</span>'))?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'commandid',array('class'=>'span5')); ?>

	<?php echo '<p>Персональные данные:</p>';
        
        echo $form->textFieldRow($model->user,'lastname', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
        echo $form->textFieldRow($model->user,'firstname', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
        
        echo $form->textFieldRow($model->user,'country', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
        echo $form->textFieldRow($model->user,'city', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
        echo $form->textFieldRow($model->user,'federation', array('size'=>60,'maxlength'=>100, 'class' => 'span5'));
        echo $form->textFieldRow($model->user,'club', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
        echo $form->textFieldRow($model->user,'post', array('size'=>30,'maxlength'=>30, 'class' => 'span4'));
        
        echo $form->textFieldRow($model,'category',array('class'=>'span5','maxlength'=>255)); 
        echo $form->textFieldRow($model,'level',array('class'=>'span5','maxlength'=>255)); 
    ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
