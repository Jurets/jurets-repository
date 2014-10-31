<?php
/* @var $this SportsmenController */
/* @var $model Sportsmen */

Yii::import('posting.models.*');

$isMyCommand = Yii::app()->user->isMyCommand($model->CommandID);
$isAccess = Yii::app()->user->isExtendRole() || $isMyCommand;

//хлеб крошки
$this->breadcrumbs = $crumbs;

//меню
$this->menu = array(
	array('label'=>Yii::t('controls', 'Update'), 'url'=>array('update', 'id'=>$model->SpID), 'icon'=>'pencil', 'visible'=>!Yii::app()->user->isGuest),
	array('label'=>Yii::t('controls', 'Delete'), 'url'=>'#', 'icon'=>'trash', 
        'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->SpID),
            'confirm'=>Yii::t('controls', "Are you sure you want to delete {item}\n{name}?", array('{item}'=>Yii::t('fullnames', ' sportsmen'), '{name}'=>$model->Fullname())), 
        ),
        'visible'=>!Yii::app()->user->isGuest,
    ),
);

?>

<h1><?php echo Yii::t('controls', 'View').': '.Yii::t('fullnames', 'sportsmen'); ?></h1>

<?php  
    
    //вывести инфо по юзеру в виджете
    $changelogContent = $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'complist-grid',
        'dataProvider'=>$dataChangeLog,
        //'template'=>"{pager}<br>{items}<br>{pager}",
        'template'=>"{items}",
        'columns'=>array(
            array(
                'header'=>Yii::t('fullnames', 'Username'),
                'value'=>'!empty($data["username"]) ? $data["username"] : $data["userid"]',
            ),  
            array(
                'header'=>Yii::t('fullnames', 'Action'),
                'value'=> 'ActiveRecordLog::actionName($data["action"])',
            ),
            array(
                'header'=>Yii::t('fullnames', 'Field'),
                'value'=>'array_key_exists($data["field"], Sportsmen::model()->attributeLabels()) ? Sportsmen::model()->attributeLabels()[$data["field"]] : $data["field"]',
                //'value'=>'$data["field"]',
            ),
            array(
                'header'=>Yii::t('fullnames', 'Date Create'),
                'type'=>'datetime',
                'value'=>'strtotime($data["creationdate"])',
                'htmlOptions'=>array('style'=>'width: 150px'),
            ),
        ),
    ), true); 

    $this->widget('bootstrap.widgets.TbTabs', array(
        //'skin'=>'default',
        'id'=>'usertab',
        'type'=>'tabs', //'pills'
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'htmlOptions' => array(
            'class' => 'table-list',
            'style' => 'font-size: 12px;'),
        'tabs'=>array(
            array(
                'label'=>Yii::t('fullnames', 'Персональные данные'), 
                'content'=>$this->renderPartial('_view', array('model'=>$model), true), 
                'active'=>true,
            ),
            array(
                'label'=>Yii::t('fullnames', 'Изменения'), 
                'content'=>$changelogContent, 
                'active'=>false,
                'visible'=>$isAccess,
            ),
        ),
    ));
?>