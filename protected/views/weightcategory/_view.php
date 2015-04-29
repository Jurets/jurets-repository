<?php
/* @var $this WeightcategoryController */
/* @var $data Weightcategory */
?>

<!--<div class="view">-->
<span>
	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('WeightID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->WeightID), array('view', 'id'=>$data->WeightID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AgeID')); ?>:</b>
	<?php echo CHtml::encode($data->AgeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WeightFrom')); ?>:</b>
	<?php echo CHtml::encode($data->WeightFrom); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('WeightTo')); ?>:</b>
	<?php echo CHtml::encode($data->WeightTo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WeightName')); ?>:</b>
	<?php echo CHtml::encode($data->WeightName); ?>
	<br />-->

    <?php echo CHtml::encode($data->getWeightNameShort()); ?>
    
</span>
    <!--</div>-->
    
<span>&nbsp;</span>