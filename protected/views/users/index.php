<?php
/* @var $this UsersController */
/* @var $dataProvider CActiveDataProvider */
//$controller = $this;

$pageid = 'page_usersindex';
$paramid = Yii::app()->request->getParam('Users_page');
if (isset($paramid))
    $pageid .= ('_'.$paramid);
$notCached = $this->beginCache($pageid, array('duration'=>60));
if($notCached) 
{

/*$isGuest = Yii::app()->isGuestUser; //определить: текущий юзер - гость

//определить: если текущий юзер = просматриваемый
$isMyUserID = (Yii::app()->user->userid == $model->UserID); 

$isExtendRole = Yii::app()->isExtendRole; //если суперюзер

if ($isExtendRole) */
    $this->breadcrumbs=array(
	    Yii::t('fullnames', 'My Cabinet')=>array('mycabinet'),
        Yii::t('fullnames', 'Users'),
    );

?>

<h1><?php echo Yii::t('fullnames', 'Users').': '.Yii::t('controls', 'List') ?></h1>

<?php 

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'users-grid',
    'dataProvider'=>$dataProvider,
    'filter'=>$model,
    //'cssFile'=>null,
    'template'=>"{pager}<br>{items}<br>{pager}",
    'type'=>'striped bordered condensed',
    'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),
    'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    'columns'=>array(
        array(
            'header'=>Yii::t('fullnames', 'UserName'),
            //'name'=>'UserName',
            //'value'=>$data->FstName  
            'type'=>'html',
            'value'=>'CHtml::link(CHtml::encode($data->UserName), CHtml::normalizeUrl(array("users/view", "id"=>$data->UserID)))',
        ),
        array(
            'header'=>Yii::t('fullnames', 'UserFIO'),
            'name'=>'UserFIO',
        ), 
        array(
            'header'=>Yii::t('fullnames', 'Status'),
            'name'=>'statusTitle',
            //'type'=>'html',
            //'value'=>'CHtml::link(CHtml::encode($data->statusTitle), CHtml::normalizeUrl(array("sportsmen/view", "id"=>$data->UserID)))',
            //'value'=>'$controller->widget("bootstrap.widgets.TbLabel", array("type"=>$data->statusCss, "label"=>$data->statusTitle))',
            //'value'=>'<span class="label label-'.$data->statusCss.'">Success</span>',
            //'value'=>'CHtml::encode(\'<span class="label label-success">Success</span>\')',
            //'value'=>'<span class="label label-success">Success</span>',
        ), 
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=> ($isAccess ? '{view}{update}{delete}' : '{view}'),
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center'),
            'deleteConfirmation'=>Yii::t('controls', "Are you sure you want to delete {item}\n{name}?", array('{item}'=>Yii::t('fullnames', ' sportsmen'), '{name}'=>$data['LastName'])),
            'buttons'=>array (
                'view' => array (
                    'label'=>Yii::t('controls', 'View'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
                    'url'=>'Yii::app()->createUrl("users/view", array("id"=>$data[UserID]))',
                    ),
                'update' => array (
                    'label'=>Yii::t('controls', 'Update'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
                    'url'=>'Yii::app()->createUrl("users/update", array("id"=>$data[UserID]))',
                    ),
                'delete' => array (
                    'label'=>Yii::t('controls', 'Delete'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                    'url'=>'Yii::app()->createUrl("users/delete", array("id"=>$data[UserID]))',
                    ),
            ),
        ), 
    )
));

$this->endCache(); 
}
?>
