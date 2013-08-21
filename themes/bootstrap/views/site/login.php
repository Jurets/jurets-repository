<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$strEnter = Yii::t('controls', 'Enter');

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	$strEnter,
);
?>

<h1><?php echo $strEnter?></h1>

<p><?php echo Yii::t('fullnames', 'Please fill out the following form with your login credentials').':'?></p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?=Yii::t('fullnames', 'Fields with {asteriks} are required.', array('{asteriks}'=>'<span class="required">*</span>'))?></p>

	<?php echo $form->textFieldRow($model, 'username'); ?>

	<?php echo $form->passwordFieldRow($model,'password',array(
        'hint'=>Yii::t('controls', 'Hint').': '.Yii::t('fullnames', 'If you enter firstly - see your login and password in your {email}',
            array('{email}' => Yii::t('fullnames', '{email}'))),
    )); ?>

	<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
                'label'=>$strEnter,
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
