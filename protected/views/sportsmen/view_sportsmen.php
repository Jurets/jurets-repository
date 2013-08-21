<?php
/* @var $this SportsmenController */
/* @var $model Sportsmen */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sportsmen-view_sportsmen-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля, помеченные звёздочкой <span class="required">*</span> являются обязательными для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'LastName',array('label'=>'Фамилия')); ?>
        <?php echo $form->textField($model,'LastName'); ?>
		<?php echo $form->error($model,'LastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FirstName',array('label'=>'Имя')); ?>
		<?php echo $form->textField($model,'FirstName'); ?>
		<?php echo $form->error($model,'FirstName'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'MiddleName',array('label'=>'Отчество')); ?>
        <?php echo $form->textField($model,'MiddleName'); ?>
        <?php echo $form->error($model,'MiddleName'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'CommandID',array('label'=>'Команда')); ?>
        <?php 
            //$commands = Command::model()->findAll();
            //$commandlist = CHtml::listData($commands, 'CommandID', 'CommandName');
            //echo $form->DropDownList($model, 'CommandID', $commandlist); 
            echo $form->DropDownList($model, 'CommandID', array('0'=>'Харьковская обл.', '1'=>'Луганская обл.', '2'=>'г.Киев')); 
        ?>
        <!-- <?php echo $form->textField($model,'CommandID'); ?> -->
		<?php echo $form->error($model,'CommandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FstID',array('label'=>'ФСТ')); ?>
        <?php echo $form->DropDownList($model, 'FstID', array('0'=>'МОН', '1'=>'Динамо', '2'=>'Колос', '3'=>'Украина')); ?>
		<!--<?php echo $form->textField($model,'FstID'); ?> -->
		<?php echo $form->error($model,'FstID'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'BirthDate',array('label'=>'Дата рождения')); ?>
        <?php echo $form->textField($model,'BirthDate'); ?>
        <?php echo $form->error($model,'BirthDate'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'CategoryID',array('label'=>'Разряд')); ?>
        <?php echo $form->DropDownList($model, 'CategoryID', array('0'=>'МС', '1'=>'КМС', '2'=>'1 разряд', '3'=>'2 разряд')); ?>
		<!--<?php echo $form->textField($model,'CategoryID'); ?>-->
		<?php echo $form->error($model,'CategoryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AttestLevelID',array('label'=>'Куп, дан')); ?>
        <?php echo $form->DropDownList($model, 'AttestLevelID', array('0'=>'1 дан', '1'=>'1 куп', '2'=>'2 куп', '3'=>'3 куп')); ?>
		<!--<?php echo $form->textField($model,'AttestLevelID'); ?>-->
		<?php echo $form->error($model,'AttestLevelID'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'Gender',array('label'=>'Пол')); ?>
        <?php echo $form->DropDownList($model, 'Gender', array('0'=>'м', '1'=>'ж')); ?>
        <!--<?php echo $form->textField($model,'Gender'); ?>-->
        <?php echo $form->error($model,'Gender'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'WeigthID',array('label'=>'Весовая категория')); ?>
        <?php echo $form->DropDownList($model, 'WeigthID', array('0'=>'до 45 кг', '1'=>'до 48 кг', '2'=>'до 51 кг', '3'=>'до 55 кг')); ?>
		<!--<?php echo $form->textField($model,'WeigthID'); ?>-->
		<?php echo $form->error($model,'WeigthID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Coach1ID',array('label'=>'Тренер')); ?>
		<?php echo $form->textField($model,'Coach1ID'); ?>
		<?php echo $form->error($model,'Coach1ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Coach2ID',array('label'=>'Первый тренер')); ?>
		<?php echo $form->textField($model,'Coach2ID'); ?>
		<?php echo $form->error($model,'Coach2ID'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'MedicSolve',array('label'=>'Разрешение врача')); ?>
        <?php echo $form->textField($model,'MedicSolve'); ?>
        <?php echo $form->error($model,'MedicSolve'); ?>
    </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->