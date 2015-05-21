<?php
/* @var $this CommandController */
/* @var $model Command */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'command-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class'=>'well'),
)); 
    // ошибки
    echo $form->errorSummary($model); 
    // вьюшка "обязательноть полей"
    $this->viewFieldsReq();    

    echo $form->textFieldRow($model,'CommandName',array('size'=>50,'maxlength'=>50));
    echo $form->textFieldRow($model,'secondname',array('size'=>255,'maxlength'=>255, 'class'=>'span6'));

    $label = ($model->isNewRecord ? Yii::t('controls', 'Add') : Yii::t('controls', 'Save'));
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>$label,
        'type'=>'primary',
        'buttonType'=>'submit',
        'htmlOptions'=>array(
            'name'=>'save_exit',
            //'title'=>$label,
            //'style'=>'margin-left: 20px;',
            //'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
        ),
    ));     
    
$this->endWidget(); //form
?>

</div><!-- form -->