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
    <?php if(isset($model->relPhoto)) : ?>
        <img width="190" height="265" title="Фото спортсмена" alt="Фото спортсмена" src="<?= Yii::app()->getUploadImageUrl($model->relPhoto->filename)?>"/>
    <?php endif ?>
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
            'value'=>$model->relCommand->CommandName
        ),
        array(
            'label'=>Yii::t('fullnames', 'FstName'),
            //'value'=>$model->FstName()
            //'value'=>$model->relFst->FstName
            'value'=>$model->fstName
        ),
        array(
            'label'=>Yii::t('fullnames', 'CategoryName'),
            //'value'=>$model->relCategory->CategoryName
            'value'=>$model->CategoryName
        ),
        array(
            'label'=>Yii::t('fullnames', 'AttestLevelName'),
            //'value'=>$model->relAttestlevel->AttestLevel
            'value'=>$model->AttestLevelName
        ),
        array(
            'label'=>Yii::t('fullnames', 'AgeName'),
            'value'=>$model->relAgecategory->AgeNameYear
        ),
        array(
            'label'=>Yii::t('fullnames', 'WeightName'),
            'value'=>mb_strtoupper($model->Gender, 'UTF-8').' '.$model->relWeightcategory->WeightNameFull
        ),
        array(
            'label'=>Yii::t('fullnames', 'CoachFirst'),
            'value'=>(isset($model->relCoachFirst) ? $model->relCoachFirst->CoachName : null)
        ),
        array(
            'label'=>Yii::t('fullnames', 'Coach'),
            'value'=>(isset($model->relCoach) ? $model->relCoach->CoachName : null)
        ),
		//'MedicSolve',
        'SpID'
	)
));
?>