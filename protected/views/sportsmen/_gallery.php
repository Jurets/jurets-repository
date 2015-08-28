<?php
//объект соревнования
$competition = Competition::getModel();

//настроечные вычисления
$isMyCommand = Yii::app()->user->isMyCommand($commandid);
$isAccess = Yii::app()->user->isExtendRole() || $isMyCommand;

/*$btn_update = array (
    'label'=>Yii::t('controls', 'Update'),
    'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
    'url'=>'Yii::app()->createUrl("sportsmen/update", array("id"=>$data[SpID]))',
);
$btn_delete = array (
    'label'=>Yii::t('controls', 'Delete'),
    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
    'url'=>'Yii::app()->createUrl("sportsmen/delete", array("id"=>$data[SpID]))',
);

//функция: подтверждение удаления
$funcConfirm = 'js:function(){
                    return confirm("' . Yii::t('controls', "Are you sure you want to delete sportsmen?") . '\n" + 
                                   $(this).parent().parent().children(\':first-child\').text() + "\n" +
                                   $(this).parent().parent().children(\':nth-child(6)\').text() + "\n" +
                                   $(this).parent().parent().children(\':nth-child(7)\').text()); 
                               }';

$delConfirm = 'js:"' . Yii::t('controls', "Are you sure you want to delete sportsmen?") . '\n" + 
                                   $(this).parent().parent().children(\':first-child\').text() + "\n" +
                                   $(this).parent().parent().children(\':nth-child(6)\').text() + "\n" +
                                   $(this).parent().parent().children(\':nth-child(7)\').text()';
*/                               


/*    array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CommandID),
        'confirm'=>'Вы действительно хотите удалить команду?'), 'visible'=>!Yii::app()->user->isGuest),
*/

//$this->widget('bootstrap.widgets.TbListView', array(
$this->widget('bootstrap.widgets.TbThumbnails', array(
    'id'=>'sportsmen-grid',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_spfoto',   // refers to the partial view named '_post'

    //'filter'=>$modelSportsmen,
    //'cssFile'=>null,
    //'template'=>"{pager}<br>{items}<br>{pager}",
    //'type'=>'striped bordered condensed',
    /*'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),*/
    //'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    //'columns'=>$arrColumns, 
));
    
?>