<?php
/* @var $this CompetitionController */
/* @var $model Competition */

$this->renderPartial('/site/manager');

?>

<h1><?php echo Yii::t('controls', 'Update').': '.Yii::t('fullnames', 'Competition'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>