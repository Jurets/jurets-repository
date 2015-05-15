<?php
    /* @var $this AgecategoryController */
    /* @var $model Agecategory */
    /* @var $form CActiveForm */
?>

<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'agecategory-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class'=>'well'),
)); 
    // ошибки
    echo $form->errorSummary($model); 
    // вьюшка "обязательноть полей"
    $this->viewFieldsReq();

    echo $form->hiddenField($model, 'CompetitionID'); 
    echo $form->textFieldRow($model,'AgeName',array('size'=>30,'maxlength'=>30));

    echo $form->dropDownListRow($model, 'Gender', 
        array('ч' => Yii::t('fullnames', 'male'), 'ж' => Yii::t('fullnames', 'female')), 
        array('empty' => '<'.Yii::t('fullnames', 'choose gender').'>'
    ));

    echo $form->textFieldRow($model,'AgeMin',array('size'=>4,'maxlength'=>4));
    echo $form->textFieldRow($model,'AgeMax',array('size'=>4,'maxlength'=>4));
    
    echo $form->textFieldRow($model,'YearMin',array('size'=>4,'maxlength'=>4));
    echo $form->textFieldRow($model,'YearMax',array('size'=>4,'maxlength'=>4));

    echo $form->textFieldRow($model,'ordernum',array('size'=>4,'maxlength'=>4));

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