<?php
    /* @var $this WeightcategoryController */
    /* @var $model Weightcategory */
    /* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action'=>$this->createUrl('/weightcategory/create', array('id'=>$age->AgeID)),
        'id'=>'weightcategory-form',
        'enableAjaxValidation'=>false,
        'type'=>'horizontal',
        'htmlOptions'=>array('class'=>'well'),
    )); 
        // ошибки
        echo $form->errorSummary($model); 
        // вьюшка "обязательноть полей"
        $this->viewFieldsReq();

        echo $form->hiddenField($model, 'AgeID'); 

        //показать ошибки
        echo $form->errorSummary($model); 

        //echo $form->textFieldRow($model,'LastName');
        echo $form->textFieldRow($model,'WeightFrom', array('size'=>20,'maxlength'=>20));
        echo $form->textFieldRow($model,'WeightTo', array('size'=>20,'maxlength'=>20));
        echo $form->textFieldRow($model,'ordernum', array('size'=>20,'maxlength'=>20));
        
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