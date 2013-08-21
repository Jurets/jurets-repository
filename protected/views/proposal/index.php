<?php
/* @var $this ProposalController */
/* @var $model Proposal */


if ($isExtendRole)
    $this->breadcrumbs=array(
        Yii::t('fullnames', 'Manage')=>array('/competition/manage'),
        Yii::t('fullnames', 'Proposals')
        //$model->relCommand->CommandName,
    );
else
    $this->breadcrumbs=array(
        Yii::t('fullnames', 'Tournament')=>array('/users/mycabinet'),
        Yii::t('fullnames', 'Proposals')
    );

$this->renderPartial('/site/_delegate');
?>

<h1>Предварительные заявки</h1>

<?php /*echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button'));*/ ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
    'model'=>$model,
));*/ ?>
</div>

<p>В настоящее время для участия в соревнованиях подано заявок от <b>#</b> команд:</p>

<?php 

$this->renderPartial('_index', array('dataProvider'=>$dataProvider));
?>

