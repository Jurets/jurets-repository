<style type="text/css">
    .table {
        width: 70% !important; 
    }
</style>
<?php
/* @var $this SportsmenController */
/* @var $model Sportsmen */

Yii::import('posting.models.*');

$this->breadcrumbs = $crumbs;

$this->menu=array(
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

<div id="sportsmen_photo" style="float: right;">
    <label class="control-label" for="sportsmen_photo">Фотография спортсмена</label>
    <?php
    if(isset($model->relPhoto)) :?>  
        <img width="190" height="265" title="Фото спортсмена" alt="Фото спортсмена" src="<?= Yii::app()->getUploadImageUrl($model->relPhoto->filename)?>"/>
    <? endif ?>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    'nullDisplay'=>'<span class="null">'.Yii::t('fullnames', 'no data').'</span>',
    //=>array('CommandName'=>$model->CommandName())
	'attributes'=>array(
        array(
            'label'=>Yii::t('fullnames', 'FullName'),
            'value'=>$model->FullName()
        ),
        'IdentCode',
        array(
            'label'=>Yii::t('fullnames', 'BirthDate'),
            'value'=>$model->BirthYear()
        ),
        array(
            'label'=>Yii::t('fullnames', 'Command'),
            //'value'=>$model->CommandName(),
            'value'=>$model->relCommand->CommandName,
        ),
        array(
            'label'=>Yii::t('fullnames', 'FstName'),
            //'value'=>$model->FstName()
            'value'=>$model->relFst->FstName,
        ),
        array(
            'label'=>Yii::t('fullnames', 'CategoryName'),
            'value'=>$model->CategoryName()
        ),
        array(
            'label'=>Yii::t('fullnames', 'AttestLevelName'),
            'value'=>$model->AttestLevelName()
        ),
        array(
            'label'=>Yii::t('fullnames', 'AgeName'),
            'value'=>$model->AgeName()
        ),
        array(
            'label'=>Yii::t('fullnames', 'WeightName'),
            'value'=>$model->WeightNameFull()
        ),
        array(
            'label'=>Yii::t('fullnames', 'CoachFirst'),
            'value'=>$model->Coach2Name()
        ),
        array(
            'label'=>Yii::t('fullnames', 'Coach'),
            'value'=>$model->Coach1Name()
        ),
		//'MedicSolve',
        'SpID',
	),
)); ?>
