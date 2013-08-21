<?php
/* @var $this PostingController */
/* @var $model Posting */

//подключить скрипт для слайдера фотогалереи
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl(true).'/javascript/common.js');

$this->breadcrumbs=array(
	Yii::t('fullnames', 'Postings')=>array('index'),
	$model->title,
);

$this->menu=array(
    array('label'=>'Мои альбомы', 'url'=>array('getalbums')),
    array('label'=>'Все фото', 'url'=>array('getphotos')),
);
?>

<h1><?php echo 'Добавление фото с сайта VKontakte'/*.' '.$model->title;*/ ?></h1>
<p class='note'>Для добавления отметьте флажками нужные фотографии, затем нажмите ниже кнопку <span class="required">Сохранить</span></p> 

<?php 
//DebugBreak();
if (isset($dataProvider)) 
{
    /*$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'vkphotolist-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>true,
        'htmlOptions'=>array('class'=>'well'),
    ));*/
    $this->beginWidget('CActiveForm', array(
        'id'=>'vkphotolist-form',
        'enableAjaxValidation'=>false,
    ));
    $this->widget('bootstrap.widgets.TbThumbnails', array(
        'dataProvider'=>$dataProvider,
        'template'=>"{items}\n{pager}",
        'itemView'=>'_thumb',
    ));
    
    
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>Yii::t('controls', 'Save'), 
        'type'=>'primary',
        'buttonType'=>'submit',
        'htmlOptions'=>array(
            //'data-toggle'=>'modal', 'data-target'=>'#myModal',
            //'data-content'=>$form->errorSummary($model), 
            //'onclick'=>'$(".vkphotosmall").attr("value", false)',
            ),
    ));    
    
    $this->endWidget(); 
    
    /*$this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'command-grid',
        'template'=>"{pager}\n{items}\n{pager}",
        'type'=>'striped bordered condensed',
        'htmlOptions' => array('class' => 'table-list'),
        'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
            array(
                'name'=>'Фото',
                'type'=>'html',  
                'value'=>'CHtml::image($data[src_small])',
                //'value'=>'CHtml::link(CHtml::encode($data->CommandName), CHtml::normalizeUrl(array("command/view", "id"=>$data->CommandID)))',
                'htmlOptions'=>array('style'=>'width: 150px'),
            ),
            array(
                'name'=>'Дата',
                //'type'=>'html',
                //'value'=>'$data->coachCount',
                'value'=>'$data[created]',
                'htmlOptions'=>array('style'=>'width: 100px'),
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{view}',
                'htmlOptions'=>array('style'=>'width: 50px; text-align: center'),
            ),
        ),
    ));*/
    
}

/*if (isset($photos)) {
    //foreach ($photos as $index => $photo) {
    for ($index = 1; $index < count($photos); $index++) {
        $photo = $photos[$index];
        //if (!empty($response->error))
        //        echo CHtml::tag('p', array('style'=>'color:red;'), $response->error->error_msg);
        //    else if ($type == 'photos') {
                //echo CHtml::image($response->response[1]->src);
                //echo CHtml::tag('div', array(), $response->response[1]->width.' x '.$response->response[1]->height);
                echo CHtml::tag('div', array(), CHtml::image($photo[src_big]));
                echo CHtml::tag('div', array(), CHtml::image($photo[src_small]));
                //echo CHtml::image($response->response[1]->src_xxbig);
            //}
        }
    }  */
/*echo CHtml::tag('hr');
echo CHtml::link('Просмотреть фотогалерею', '#', 
    array('onclick'=>'popUp("'.Yii::app()->createAbsoluteUrl('posting/default/show', array('id'=>$model->post_id)).'");return false')
);*/
?>
