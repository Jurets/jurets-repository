<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
    $isMyUserID = (Yii::app()->user->userid == $model->UserID); 

    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'users-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>true,
        'htmlOptions'=>array('class'=>'well'),
    )); 

    $help_str = Yii::t('fullnames', 'Fields with {asteriks} are required.', array('{asteriks}'=>'<span class="required">*</span>')).'<br>';
    if ($isMyUserID) $help_str .= 
        Yii::t('fullnames', 'Field {email} will be used for enter on site. In future login and password may be changed', 
            array('{email}'=>'<span class="required">'.Yii::t('fullnames', 'Email').'</span>')).'<br>'.
        Yii::t('fullnames', 'The initial password will be generated automatically').'<br>'.
        Yii::t('fullnames', 'Field {email} will be used for password recovery', 
            array('{email}'=>'<span class="required">E-mail</span>')).'<br>'.
        Yii::t('fullnames', 'After the registration on this E-mail will send message with info about initiant password. Only after that you may enter information about proposals');
            
    echo CHtml::tag('p', array('class'=>'note'), $help_str);

    echo $form->hiddenField($model, 'UserID');
    //echo $form->textFieldRow($model,'commandname', array('size'=>60,'maxlength'=>100, 'class' => 'span5'));
    if (empty($model->UserID)) {
        echo $form->textFieldRow($model,'Email', array('size'=>60,'maxlength'=>100, 'class' => 'span5'));
    }

    echo $form->textFieldRow($model,'lastname', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo $form->textFieldRow($model,'firstname', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    
    echo $form->textFieldRow($model,'country', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo $form->textFieldRow($model,'city', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo $form->textFieldRow($model,'federation', array('size'=>60,'maxlength'=>100, 'class' => 'span5'));
    echo $form->textFieldRow($model,'club', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    echo $form->textFieldRow($model,'post', array('size'=>30,'maxlength'=>30, 'class' => 'span4'));

    echo $form->textFieldRow($model,'address', array('size'=>90,'maxlength'=>255, 'class' => 'span6'));
    echo $form->textFieldRow($model,'www', array('size'=>90,'maxlength'=>255, 'class' => 'span6'));
    echo $form->textFieldRow($model,'phone', array('size'=>60,'maxlength'=>100, 'class' => 'span5'));
    //echo $form->textFieldRow($model,'participantcount');
    //echo $form->textFieldRow($model,'login', array('size'=>10,'maxlength'=>10, 'class' => 'span3'));    
    echo $form->textAreaRow($model,'comment', array('rows'=>4, 'cols'=>50, 'class' => 'span6'));
    
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