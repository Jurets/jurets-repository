<?php
//объект соревнования
$competition = Competition::getModel();

//настроечные вычисления
$myCommandID = Yii::app()->user->getCommandid(); //ИД Моей команды
$isMyCommand = !Yii::app()->user->isGuest && ($commandid == $myCommandID);
$isAccess = Yii::app()->user->isExtendRole() || $isMyCommand;

$btn_update = array (
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
                               
$arrColumns = array(
        array(
            //'name'=>'searchFullName',
            'name'=>'FullName',
            'header'=>Yii::t('fullnames', 'LastName').', '.Yii::t('fullnames', 'FirstName'),
            'type'=>'html',
            //'value'=>'$data->FullName',
            'filterInputOptions'=>array('style'=>'width: 180px;'),
            'headerHtmlOptions'=>array('style'=>'width: 190px;'),
            'value'=>'CHtml::link(CHtml::encode($data["FullName"]), CHtml::normalizeUrl(array("sportsmen/view", "id"=>$data["SpID"])))',
        ));
 
if (!isset($commandid) || empty($commandid))
    $arrColumns[] = array(
            'header'=>Yii::t('fullnames', 'Command'),
            'name'=>'Commandname',
            'filter'=>false,
        );

$arrColumns = CMap::mergeArray($arrColumns, array(
        array(
            'header'=>Yii::t('fullnames', 'FstName'),
            'name'=>'FstName',
            'filter'=>false,
        ),
        array(
            'header'=>Yii::t('fullnames', 'CategoryName'),
            'name'=>'CategoryName',
            'filter'=>false,
        ), 
        array(
            'header'=>Yii::t('fullnames', 'AttestLevelName'),
            'name'=>'AttestLevelName',
            'filter'=>false,
        ), 
        array(
            'name'=>'BirthYear',
            'header'=>Yii::t('fullnames', 'BirthYear'),
            'filter'=>false,
            'value'=>'date("Y", strtotime($data->BirthDate))',
        ), 
        array(
            'name'=>'searchAgeName',
            'header'=>Yii::t('fullnames', 'Age'),
            'value'=>'$data->AgeName',
            'filter'=>CHtml::listData(Agecategory::getAges(), 'AgeID', 'AgeNameYear'), 
            /*'filter'=>CHtml::activeDropDownList($modelSportsmen, 'AgeID', 
                CHtml::listData(Agecategory::getAges(), 'AgeID', 'AgeNameYear'),
                array('empty' => ''*/ 
                      /*'<'.Yii::t('controls', 'Choose age category').'>',*/
                      //'readonly'=>!isset($model->BirthDate) || empty($model->BirthDate //true,
                //)),
            'filterInputOptions'=>array('style'=>'width: 150px; font-size: 12px;'),
            'headerHtmlOptions'=>array('style'=>'width: 160px;'),
        ),
        array(
            'header'=>Yii::t('fullnames', 'Weight'),
            'name'=>'WeightNameFull',
            'filter'=>false,
            'value'=>'$data->WeightNameShort',
            'visible'=>!$competition->isCamp,
        ),
        array(
            'header'=>Yii::t('fullnames', 'Coach'),
            'name'=>'searchCoachName',
            'value'=>'$data->CoachName',
            'filter'=>CHtml::listData(Sportsmen::getCoachList($commandid), 'CoachID', 'CoachName'),
            'filterInputOptions'=>array('style'=>'width: 150px; font-size: 12px;'),
            'headerHtmlOptions'=>array('style'=>'width: 160px;'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=> ($isAccess ? '{view}&nbsp;{update}&nbsp;{delete}' : '{view}'),
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center'),
            //'deleteConfirmation'=>Yii::t('controls', "Are you sure you want to delete {item}\n{name}?", array('{item}'=>Yii::t('fullnames', ' sportsmen'), '{name}'=>'$data["LastName"]')),
            'deleteConfirmation'=>$delConfirm,
            'buttons'=>array (
                'view' => array (
                    'label'=>Yii::t('controls', 'View'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
                    'url'=>'Yii::app()->createUrl("sportsmen/view", array("id"=>$data["SpID"]))',
                    ),
                'update' => array (
                    'label'=>Yii::t('controls', 'Update'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
                    'url'=>'Yii::app()->createUrl("sportsmen/update", array("id"=>$data["SpID"]))',
                    ),
                'delete' => array (
                    'label'=>Yii::t('controls', 'Delete'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                    'url'=>'Yii::app()->createUrl("sportsmen/delete", array("id"=>$data["SpID"]))',
                    //'click'=>'js:function(){return confirm("Are you sure you want to delete ' . CComponent::evaluateExpression('$data"LastName"]') . '?");}',
                    //'click'=>$funcConfirm,
                    ),
            ),
        ),
));

/*    array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CommandID),
        'confirm'=>'Вы действительно хотите удалить команду?'), 'visible'=>!Yii::app()->user->isGuest),
*/

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'sportsmen-grid',
    'dataProvider'=>$dataProvider,
    'filter'=>$modelSportsmen,
    //'cssFile'=>null,
    'template'=>"{pager}<br>{items}<br>{pager}",
    'type'=>'striped bordered condensed',
    'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),
    'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    'columns'=>$arrColumns, 
));
    
?>
