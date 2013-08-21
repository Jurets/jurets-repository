<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

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
        <?=Yii::t('fullnames', 'For change your password firstly type your old password, then enter new password and retype it in same field')?><br>
        <?=Yii::t('fullnames', 'After password changing e-mail message will be sended on your mailbox')?>.<br>
    </p>

<?php
    echo $form->hiddenField($model, 'UserID');
    
    echo $form->passwordFieldRow($model,'old_password', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo $form->passwordFieldRow($model,'new_password', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo $form->passwordFieldRow($model,'retype_password', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo '<hr>';
    
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>($model->isNewRecord ? Yii::t('controls', 'Registry') : Yii::t('controls', 'Save')), 
        'type'=>'primary',
        'buttonType'=>'submit',
        'htmlOptions'=>array(
            //'data-toggle'=>'modal', 'data-target'=>'#myModal',
            //'data-content'=>$form->errorSummary($model), 
            //'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
            ),
    ));    
    echo $form->errorSummary($model); 

    $this->endWidget(); 

?>    

</div><!-- form -->