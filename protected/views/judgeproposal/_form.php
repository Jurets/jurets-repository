<?php
/* @var $this ProposalController */
/* @var $model Proposal */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
$js=<<<JS
function toggleMode(radio) {
  $("#groupCommandname").toggleClass("hidden");
  $("#groupCommandID").toggleClass("hidden");
  return false;
};
JS;
Yii::app()->clientScript->registerScript('postHelp', $js, CClientScript::POS_HEAD);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'proposal-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'well'),
)); 

    echo $form->errorSummary($model); 

?>

	<p class="note">
        <?=Yii::t('fullnames', 'Fields with {asteriks} are required.', array('{asteriks}'=>'<span class="required">*</span>'))?>    <br>
    </p>

<?php 
    echo $form->hiddenField($model, 'id');
    echo $form->hiddenField($model, 'competitionid');
    echo $form->hiddenField($model, 'judgeid');
    
    /*echo CHtml::tag('p', array(), 'Вы можете выбрать один из режимов регистрации заявки. Перед этим желательно ознакомиться со списком существующих команд:');
    echo $form->radioButtonListRow($model, 'modeCommand', array(
            'Существующая команда',
            'Новая команда',
        ), array(
            //'onclick'=>'alert("Hello!" + " " + $(this).attr("value"))', 
            'onclick'=>'toggleMode($(this))',
        )
        );*/
    
    //if ($model->modeCommand == Proposal::COMMAND_NEW)
    //echo CHtml::tag('div', array('class'=>'hidden', 'id'=>'groupCommandname'), '', false);
    ////    echo $form->textFieldRow($model,'commandname', array('size'=>60,'maxlength'=>100, 'class' => 'span5'));
    //echo CHtml::tag('/div');
    //else if ($model->modeCommand == Proposal::COMMAND_EXIST)
    /*echo CHtml::tag('div', array('id'=>'groupCommandID'), '', false);
        echo $form->dropDownListRow($model, 'commandid', 
            CHtml::listData(Command::model()->findAll(), 'CommandID', 'CommandName'), array(
                'empty' => '<'.Yii::t('controls', 'Choose command').'>',
                'class' => 'span5',
        )); 
    echo CHtml::tag('/div');*/

    //echo $form->textFieldRow($model,'country', array('size'=>50,'maxlength'=>50, 'class' => 'span4'/*, 'disabled'=>'disabled'*/));
    //echo $form->textFieldRow($model,'city', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    //echo $form->textFieldRow($model,'federation', array('size'=>60,'maxlength'=>100, 'class' => 'span5'));
    //echo $form->textFieldRow($model,'club', array('size'=>50,'maxlength'=>50, 'class' => 'span4'));
    //echo $form->textFieldRow($model,'address', array('size'=>90,'maxlength'=>255, 'class' => 'span6'));
    
    //echo $form->textFieldRow($model,'participantcount');
    
    //echo $form->textFieldRow($model,'login', array('size'=>10,'maxlength'=>10, 'class' => 'span3'));    
    //echo $form->textFieldRow($model,'email', array('size'=>60,'maxlength'=>100, 'class' => 'span5'));
    
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

    $this->endWidget(); 
?>

</div><!-- form -->