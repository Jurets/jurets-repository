<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Вход',
);
?>

<h1><?php echo Yii::t('fullnames', 'Login'); ?></h1>


<?php
  //компонент показа всплывающих сообщений (Алерт)  
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true/*, 'closeText'=>'&times;'*/), // success, info, warning, error or danger
            'error'=>array('block'=>true, 'fade'=>true), 
            'warning'=>array('block'=>true, 'fade'=>true), 
        ),
    ));
?>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
    'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); 

    // ошибки
    //echo $form->errorSummary($model); 
    // вьюшка "обязательноть полей"
    $this->viewFieldsReq();

    echo $form->textFieldRow($model,'username', array());
    echo $form->passwordFieldRow($model,'password', array());
    echo $form->checkBoxRow($model,'rememberMe');

    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>Yii::t('controls', 'Enter'),
        'type'=>'primary',
        'buttonType'=>'submit',
        'htmlOptions'=>array(
            'name'=>'save_exit',
            //'title'=>$label,
            //'style'=>'margin-left: 20px;',
            //'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
        ),
    ));        
    
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>Yii::t('controls', 'Recovery password'),
        //'type'=>'primary',
        'buttonType'=>'link',
        'url'=>Yii::app()->createAbsoluteUrl('users/recovery'),
        'htmlOptions'=>array(
            'name'=>'recovery',
            'class'=>'btn btn-link',
        ),
    ));
    
$this->endWidget(); //form
    
?>
</div><!-- form -->
