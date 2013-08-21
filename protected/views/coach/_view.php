<?php
/* @var $this CoachController */
/* @var $data Coach */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CoachID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CoachID), array('view', 'id'=>$data->CoachID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CommandID')); ?>:</b>
	<?php echo CHtml::encode($data->CommandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CoachName')); ?>:</b>
	<?php echo CHtml::encode($data->CoachName); ?>
	<br />


</div>