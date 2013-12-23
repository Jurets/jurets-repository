<?php
/* @var $this CompetitionController */
/* @var $model Competition */
/* @var $form CActiveForm */
?>

<!--<div class="form">-->

<?php 
/*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'competition-form',
	'enableAjaxValidation'=>false,
)); */

/*$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'competition-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'well'),
));*/ 

?>

<p class="note"><?=Yii::t('fullnames', 'Fields with {asteriks} are required.', array('{asteriks}'=>'<span class="required">*</span>'))?></p>

<?php 
    //echo $form->errorSummary($model); 
    //echo $form->hiddenField($model, 'id');
    
        echo $form->textFieldRow($model,'name',array('size'=>50,'maxlength'=>50, 'class'=>'span4'));
        echo $form->textFieldRow($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'span6'));

        echo $form->textFieldRow($model,'begindate');
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'=>$model,
            'name' => 'Competition[begindate]',
            'value' => $model->begindate,
            //'mode'=>'datetime',
            'options'=>array('dateFormat'=>'yy-mm-dd', 'timeFormat'=>'hh:mm:ss'),
            'language'=>'ru'
        ),true);        
        
        echo $form->textFieldRow($model,'enddate');
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'=>$model,
            'name' => 'Competition[enddate]',
            'value' => $model->enddate,
            'options'=>array('dateFormat'=>'yy-mm-dd', 'timeFormat'=>'hh:mm:ss'),
            'language'=>'ru'
        ),true);        
        
        echo $form->textFieldRow($model,'place',array('size'=>60,'maxlength'=>255, 'class'=>'span6'));
        
        echo $form->dropDownListRow($model, 'courtcount', array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10), 
            array('empty' => '<'.Yii::t('controls', 'Choose count').'>', 'class'=>'span1')
            ); 
        
        echo $form->textFieldRow($model,'filingbegin');
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'=>$model,
            'name' => 'Competition[filingbegin]',
            'value' => $model->filingbegin,
            'options'=>array('dateFormat'=>'yy-mm-dd', 'timeFormat'=>'hh:mm:ss'),
            'language'=>'ru'
        ),true);        

        echo $form->textFieldRow($model,'filingend');
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'=>$model,
            'name' => 'Competition[filingend]',
            'value' => $model->filingend,
            'options'=>array('dateFormat'=>'yy-mm-dd', 'timeFormat'=>'hh:mm:ss'),
            'language'=>'ru'
        ),true);        

        echo $form->textFieldRow($model,'maxparticipants',array('class'=>'span1'));
        echo $form->checkBoxRow($model,'isfiling');

        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>($model->isNewRecord ? Yii::t('controls', 'Create') : Yii::t('controls', 'Save')), 'type'=>'primary',
            'buttonType'=>'submit',
            'htmlOptions'=>array(
                //'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
                ),
        ));    

        //echo $form->errorSummary($model); 
        
?>

	<!--<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>  -->

<?php //$this->endWidget(); ?>

<!-- </div>form -->