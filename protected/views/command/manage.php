<?php
/* @var $this CommandController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
    Yii::t('fullnames', 'Command List'),
);*/

    $this->renderPartial('/site/manager');
    $this->breadcrumbs['Управление командами'] = array('command/manage');
?>

<h3>Управление командами<?php //echo Yii::t('fullnames', 'Command List'); ?></h3>

<?php 
    $this->renderPartial('_index', array('dataProvider'=>$dataProvider));
    
    $this->renderPartial('application.views.competition._stat', array('dataStat'=>$dataStat));
?>