<?php
/* @var $this CoachController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Участники'=>array('/command/index'),
	'Тренеры',
);

$this->renderPartial('/site/manager');
?>

<h1>Список тренеров</h1>

<?php 
    $this->renderPartial('_coach', array(
        //'sportsmen'=>$model->relSportsmen,
        //      'commandid'=>$commandid,
              'dataProvider'=>$dataProvider,
              ));

?>
