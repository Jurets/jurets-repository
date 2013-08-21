<?php
/* @var $this SportsmenController */

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Participants')=>array('/command/index'),
    Yii::t('fullnames', 'Sportsmens'),
);

$this->renderPartial('/site/_delegate');
?>

<?php  
    $this->renderPartial('_sportsmen', array(
        //'sportsmen'=>$model->relSportsmen,
              'commandid'=>$commandid,
              'dataProvider'=>$dataProvider,
              ));
 
?>