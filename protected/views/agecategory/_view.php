<?php
/* @var $this AgecategoryController */
/* @var $data Agecategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('AgeName')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->AgeName), array('view', 'id'=>$data->AgeID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Gender')); ?>:</b>
	<?php echo CHtml::encode($data->Gender); ?>
	<!--<br />-->

	<!--<b><?php /*echo CHtml::encode($data->getAttributeLabel('AgeMin')); ?>:</b>
	<?php echo CHtml::encode($data->AgeMin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AgeMax')); ?>:</b>
	<?php echo CHtml::encode($data->AgeMax);*/ ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('YearMin')); ?>:</b>
	<?php echo CHtml::encode($data->YearMin); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('YearMax')); ?>:</b>
	<?php echo CHtml::encode($data->YearMax); ?>
	
    <!--<b><?php /*echo CHtml::encode($data->getAttributeLabel('AgeID')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->AgeID), array('view', 'id'=>$data->AgeID));*/ ?>
    <br />-->
    <br>
    
<?php
    echo CHtml::tag('a', array(
        'href'=>Yii::app()->createUrl('/weightcategory/index', array('id'=>$data->AgeID)),
        'class'=>'btn btn-mini btn-primary',
        'title'=>Yii::t('fullnames', 'Весовые'),
        //'style'=>'margin-left: 10px;'
    ), Yii::t('controls', 'Весовые'));

    if (Yii::app()->user->isExtendRole()) {
        echo CHtml::tag('a', array(
            'href'=>Yii::app()->createUrl('/agecategory/update', array('id'=>$data->AgeID)),
            'class'=>'btn btn-mini btn-primary',
            'title'=>Yii::t('fullnames', 'Edit'),
            'style'=>'margin-left: 10px;'
        ), Yii::t('controls','Edit'));
    }
?>
</div>
<br>
