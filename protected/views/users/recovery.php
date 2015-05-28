<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Login')=>array('site/index'),
    Yii::t('fullnames', 'Password recovery'),
);

//$this->renderPartial('_menu', array('model'=>$model));
?>

<h1><?php echo Yii::t('fullnames', 'Password recovery'); ?></h1>


<div class="form">

<?php 

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'users-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'well'),
)); 

?>
    <p class="note">
        <?php 
            echo Yii::t('controls', 'Type your username (email) and press the button below') . '<br>';
            echo Yii::t('controls', 'A new password will be generated and sent to your email'); 
        ?>
    </p>

<?php
    // емейл адрес для восстановления пароля
    //echo $form->textFieldRow($model, 'Email', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo $form->textFieldRow($model, 'UserName', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo '<hr>';
    
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>Yii::t('controls', 'Send'), 
        'type'=>'primary',
        'buttonType'=>'submit',
        'htmlOptions'=>array(
            'id'=>'recovery_submit',
            'name'=>'recovery_submit',
            //'data-toggle'=>'modal', 'data-target'=>'#myModal',
            //'data-content'=>$form->errorSummary($model), 
            'onclick'=>'js:$("#recovery_submit").attr("disabled", true)',
        ),
    ));    
    //echo $form->errorSummary($model); 

$this->endWidget(); 
?>    

</div><!-- form -->