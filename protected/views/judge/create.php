<?php
$this->breadcrumbs=array(
	'Judges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Judge','url'=>array('index')),
	array('label'=>'Manage Judge','url'=>array('admin')),
);
?>

<h1>Регистрация судьи</h1>

<?php 
    //echo $this->renderPartial('_form', array('model'=>$model)); 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'judge-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'well'),
)); 
    echo $this->renderPartial('application.views.users._userfields', array(
        'model'=>$model->user, 
        'form'=>$form,
    )); 
    echo CHtml::tag('hr');
    echo $this->renderPartial('_judgefields', array(
        'model'=>$model,
        'form'=>$form
    )); 
    echo CHtml::tag('hr');
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