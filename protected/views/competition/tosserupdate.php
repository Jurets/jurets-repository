<?php
$this->renderPartial('/site/manager');
?>

<h1>Редактирование жеребьёвки</h1>

<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'competition-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'well'),
)); 

        echo $form->errorSummary($model); 
        echo $form->hiddenField($model, 'id');

        echo $form->textArea($model, 'tossercontent', array('rows' => 20, 'cols' => 100, 'style'=>'width: 800px; height: 446px'));
        echo $form->textFieldRow($model, 'tosserstatus', array('size'=>3,'maxlength'=>5, 'class'=>'span1'));
        
        //кнопка сабмита
        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>($model->isNewRecord ? Yii::t('controls', 'Create') : Yii::t('controls', 'Save')), 'type'=>'primary',
            'buttonType'=>'submit',
            'htmlOptions'=>array(
                //'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
                ),
        ));        

$this->endWidget();
?>
