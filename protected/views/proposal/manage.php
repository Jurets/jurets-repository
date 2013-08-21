<?php
/* @var $this ProposalController */
/* @var $model Proposal */
?>

<h2><?php echo Yii::t('fullnames', 'Proposals')?></h2>

<?php
    $this->renderPartial('/site/manager');
    
    $this->renderPartial('/proposal/_index', array('dataProvider'=>$dataProvider,));
?>