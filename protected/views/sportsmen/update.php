<?php
/* @var $this SportsmenController */
/* @var $model Sportsmen */

$this->breadcrumbs = $crumbs;
?>

<h1><?php echo Yii::t('controls', 'Update').': '.Yii::t('fullnames', 'sportsmen'); ?></h1>

<?php echo $this->renderPartial('_form', array(
    'model'=>$model,
    'extendRole'=>$extendRole,
    'years'=>$years,
)); ?>