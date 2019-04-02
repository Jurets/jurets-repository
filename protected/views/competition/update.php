<?php
/* @var $this CompetitionController */
/* @var $model Competition */
/* @var $form CActiveForm */

Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

$this->renderPartial('/site/manager');
/*$this->breadcrumbs = array(
    'Редактировать данные соревнования'
);*/ 

?>

<!--<h1><?php echo Yii::t('controls', 'Update').': '.Yii::t('fullnames', 'Competition'); ?></h1>-->

<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>

<div class="form">

<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'competition-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'well', 'enctype'=>"multipart/form-data"),
)); 

        echo $form->errorSummary($model); 
        echo $form->hiddenField($model, 'id');

        $content = $this->renderPartial('_form', array('model'=>$model, 'form'=>$form), true) ;
        $tabs[] = array('label'=>'Основные', 'content'=>$content, 'active'=>true);
        
        //вкладка "Главная страница соревнования"
        /*$content = $this->widget('ImperaviRedactorWidget', array(
            // You can either use it for model attribute
            'model' => $model,
            'attribute' => 'invitation',
            'name' => 'Competition[invitation]', // or just for input field
            'htmlOptions'=>array(),
            // Some options, see http://imperavi.com/redactor/docs/
            'options' => array(
                'lang' => 'ru',
                'toolbar' => true,
                'iframe' => false,
                //'css' => 'wym.css',
                'direction' => 'ltr',
                'minHeight'=>600,
                'maxHeight'=>600,
                'linebreaks'=>true,
                'allowedTags'=>array(
                    'p', 'div', 'a', 'br', 'img', 
                    'h1', 'h2', 'h3', 
                    'ul', 'ol', 'li', 
                    'b', 'i', 'u', 'strike',
                ),
                'changeCallback' => 'js:function(html){$("#Competition_isInviteChanged").attr("value", "1");}',
            )
        ), true) . '<br>';*/
        $content = $form->textArea($model,'invitation', array('rows' => 10, 'cols' => 100, 'style'=>'width: 800px; height: 446px'));
        $content .= $form->fileFieldRow($model, 'files[]', array('multiple'=>true));
        $tabs[] = array('label'=>'Главная страница', 'content'=>$content, 'active'=>false); 
        
        //вывести Табы для редактирования соревнования
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type'=>'tabs',
            'placement'=>'above', // 'above', 'right', 'below' or 'left'
            'tabs'=>$tabs,
        ));
        
        //кнопка сабмита
        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>($model->isNewRecord ? Yii::t('controls', 'Create') : Yii::t('controls', 'Save')), 'type'=>'primary',
            'buttonType'=>'submit',
            'htmlOptions'=>array(
                //'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
                ),
        ));        
    ?>

    <!--<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>  -->

<?php $this->endWidget(); ?>

</div><!-- form -->