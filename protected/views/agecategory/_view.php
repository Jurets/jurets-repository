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
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AgeMin')); ?>:</b>
	<?php echo CHtml::encode($data->AgeMin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AgeMax')); ?>:</b>
	<?php echo CHtml::encode($data->AgeMax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('YearMin')); ?>:</b>
	<?php echo CHtml::encode($data->YearMin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('YearMax')); ?>:</b>
	<?php echo CHtml::encode($data->YearMax); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('AgeID')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->AgeID), array('view', 'id'=>$data->AgeID)); ?>
    <br />


</div>