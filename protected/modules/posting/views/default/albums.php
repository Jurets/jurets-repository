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
	/*array('label'=>Yii::t('fullnames', 'List Posting'), 'url'=>array('index')),
	array('label'=>Yii::t('fullnames', 'Create Posting'), 'url'=>array('create')),
	array('label'=>Yii::t('fullnames', 'Update Posting'), 'url'=>array('update', 'id'=>$model->post_id)),
	array('label'=>Yii::t('fullnames', 'Delete Posting'), 'url'=>'#', 
        'linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),
        'confirm'=>Yii::t('fullnames', 'Are you sure you want to delete this item?'))
    ),*/
	//array('label'=>'Manage Posting', 'url'=>array('admin')),
    array('label'=>'Мои альбомы', 'url'=>array('getalbums')),
    array('label'=>'Все фото', 'url'=>array('getphotos')),
);
?>

<h1><?php echo 'Добавление фото с сайта VKontakte'/*.' '.$model->title;*/ ?></h1>

<p class='note'>Ниже отображены Ваши альбомы из вашей учётной записи выбранной социальной сети. Для добавления фото выберите нужный альбом или нажмите ссылку <?php echo CHtml::link('Все фото', Yii::app()->createAbsoluteUrl('posting/default/getphotos')) ?></p> 

<?php 
//DebugBreak();
if (isset($dataProvider)) {
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'command-grid',
        'template'=>"{pager}\n{items}\n{pager}",
        'type'=>'striped bordered condensed',
        'htmlOptions' => array('class' => 'table-list'),
        'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
            array(
                'name'=>'Фотоальбом',
                'type'=>'html',  
                'value'=>'CHtml::link(CHtml::image($data[thumb_src]), Yii::app()->createAbsoluteUrl("posting/default/getphotos", array("album" => $data[aid])))',
                //'value'=>'CHtml::link(CHtml::encode($data->CommandName), CHtml::normalizeUrl(array("command/view", "id"=>$data->CommandID)))',
                'htmlOptions'=>array('style'=>'width: 150px'),
            ),
            array(
                'name'=>'Название',
                //'type'=>'html',
                //'value'=>'$data->sportsmenCount',
                'value'=>'$data[title]',
                'htmlOptions'=>array('style'=>'width: 150px'),
            ),
            array(
                'name'=>'Описание',
                //'type'=>'html',
                //'value'=>'$data->coachCount',
                'value'=>'$data[description]',
                'htmlOptions'=>array('style'=>'width: 300px'),
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
    ));
    
}

if (isset($photos)) {
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
    }
/*if (isset($albums)) {
    //foreach ($photos as $index => $photo) {
    for ($index = 0; $index < count($albums); $index++) {
        //$photo = $albums[$index]['titlephoto'];
        $photo = $albums[$index]['thumb_src'];
        echo CHtml::tag('div', array(), CHtml::image($photo));
        //if (!empty($response->error))
        //        echo CHtml::tag('p', array('style'=>'color:red;'), $response->error->error_msg);
        //    else if ($type == 'photos') {
                //echo CHtml::image($response->response[1]->src);
                //echo CHtml::tag('div', array(), $response->response[1]->width.' x '.$response->response[1]->height);
                //echo CHtml::tag('div', array(), CHtml::image($photo[src_big]));
                //echo CHtml::tag('div', array(), CHtml::image($photo[src_small]));
                //echo CHtml::image($response->response[1]->src_xxbig);
            //}
        }
    } */

    
echo CHtml::tag('hr');
//echo CHtml::link('Все фото', Yii::app()->createAbsoluteUrl('posting/default/getphotos'));

?>
