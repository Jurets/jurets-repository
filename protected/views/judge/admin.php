<?php
$isExtendRole = Yii::app()->isExtendRole;

if ($isExtendRole)
    $this->breadcrumbs=array(
        Yii::t('fullnames', 'Manage')=>array('/competition/view'),
        Yii::t('fullnames', 'Proposals')
        //$model->relCommand->CommandName,
    );
else
    $this->breadcrumbs=array(
        Yii::t('fullnames', 'Tournament')=>array('/users/mycabinet'),
        Yii::t('fullnames', 'Proposals')
    );

$this->renderPartial('/site/manager');

?>

<h1><?php echo Yii::t('fullnames', 'Judges') ?></h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
));*/ ?>
</div>-->
<!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'judge-grid',
    'template'=>"{pager}<br>{items}<br>{pager}",
    'type'=>'striped bordered condensed',
    'htmlOptions' => array(
        'class' => 'table-list',
        'style' => 'font-size: 12px;'),
    //'dataProvider'=>$model->search(),
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'id',
        array(
            'header'=>'#',
            'value'=>'$row + 1',
        ),
        /*array(
            'name'=>'BirthYear',
            'header'=>Yii::t('fullnames', 'BirthYear'),
            'filter'=>false,
            'value'=>'date("Y", strtotime($data->BirthDate))',
            'headerHtmlOptions'=>array('style'=>'width: 38px;'),
        ),*/ 
        array(
            'header'=>'ФИО',
            'type'=>'html',
            //'value'=>'CHtml::link(CHtml::encode($data->judge->user->UserFIO), '.$urlview.')',
            'value'=>'$data->judge->user->UserFIO',
        ),
        array(
            'header'=>'Категория',
            'value'=>'$data->judge->category',
        ),
        array(
            'header'=>'Дан',
            'value'=>'$data->judge->level',
        ),
        array(
            'name'=>'country',
            //'header'=>$model->judge->user->getAttributeLabel("country"),
            'value'=>'$data->judge->user->country',
        ),
        array(
            'name'=>'city',
            'value'=>'$data->judge->user->city',
        ),
		//'userid',
		/*'category',
		'level',
		'competitionid',
		'commandid',*/
		/*
		'status',
		'created',
		*/
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
