<?php
/* @var $this ProposalController */
/* @var $model Proposal */

?>

<h3><?php echo Yii::t('fullnames', 'Proposals')?></h3>

<?php
    $this->renderPartial('/site/manager');
    $this->breadcrumbs['Предварительные заявки'] = array('proposal/manager');
    //$this->breadcrumbs[] = 'Предварительные заявки';
    
    $this->renderPartial('/proposal/_index', array('dataProvider'=>$dataProvider,));
?>