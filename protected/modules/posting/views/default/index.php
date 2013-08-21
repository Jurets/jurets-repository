<?php
/* @var $this PostingController */
/* @var $dataProvider CActiveDataProvider */

//Определить - с расширенной ли ролью (admin, manager) текущий пользователь
$isExtendRole = Yii::app()->user->isExtendRole();

//подключить скрипт для слайдера фотогалереи
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl(true).'/javascript/common.js');

$this->breadcrumbs=array(
	Yii::t('fullnames', 'Postings'),
);

if ($isExtendRole) {
    $this->menu=array(
	    array('label'=>Yii::t('fullnames', 'Create Posting'), 'url'=>array('create')),
	    //array('label'=>Yii::t('fullnames', 'Manage Posting'), 'url'=>array('admin')),
        array('label'=>'Добавить из VKontakte', 'url'=>array('getalbums')),
    );
}
?>

<style>
div.loading {
    /*background-color: #eee;*/
    background-image: url('<?php echo Yii::app()->getBaseUrl(true).'/images/';?>loading.gif');
    background-position: center center;
    background-repeat: no-repeat;
    opacity: 1;
    width: 128px;
    height: 128px;
    /*margin-right: 20px;*/
    /*z-index: 555;*/
}
 
div.loading * {
    opacity: .8;
}
</style>


<h1><?php echo Yii::t('fullnames', 'List Posting'); ?></h1>

<p><?=Yii::t('fullnames', 'Choose gallery for viewing by click on ref or image')?></p>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 


//если расширенная роль - внедрить модальное окно,
//  а также зарегистрировать скрипт (всё для удаления галереи)
if ($isExtendRole) {
?>

<div class="modal hide fade" id="myModal">
    <div id="divLoading" style="float: left;"></div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Подтверждение удаления</h3>
    </div>
    <div class="modal-body">
        <p>Удалить фотогалерею</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
        <button class="btn btn-primary">Удалить</button>
    </div>
</div>

<?php

//если расширенная роль - зарегистрировать скрипт для удаления галереи

$js = <<<JS
$(".delete").click(function() {
  $(".btn-primary").attr('delelem', $(this).attr('id'));
  $(".btn-primary").on('click', function(ev) {
    id = $(this).attr('delelem');
    elem = $('#' + id);
    $('#myModal').modal('hide'); //скрыть модальное окно
    //переместить блок с индикатором загрузки      
    $('#' + elem.attr("control")).after($("#divLoading"));    // из модального блока в вьюитем галереи
    //elem.hide();                         //скрыть кнопку удаления
    $('#' + elem.attr("control")).hide(); //скрыть кнопку редактирования
    $("#divLoading").addClass("loading"); //показать процесс (добавлением класса)
    //удаление методом AJAX
    $.ajax({
      url: elem.attr('url'),
      type: "POST",
      dataType: "json",

      success: 
      function(data) {
        showInterval = setInterval(function () {
            $("#divLoading").removeClass("loading"); //убрать процесс
            $('#myModal').after($("#divLoading"));
            delelem = elem.parent().parent().parent();
            delelem.fadeOut(500, function(){ 
                delelem.remove(); 
            });
            clearInterval(showInterval);
            return false;
        }, 1000);
      }
    });
    
  });
  $('#myModal').modal('show');
  return false;
});
JS;


Yii::app()->clientScript->registerScript('postHelp', $js, CClientScript::POS_END);
} 
   
?>