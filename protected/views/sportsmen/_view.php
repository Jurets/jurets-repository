<?php
/* @var $this SportsmenController */
/* @var $data Sportsmen */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SpID), array('view', 'id'=>$data->SpID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastName')); ?>:</b>
	<?php echo CHtml::encode($data->LastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FirstName')); ?>:</b>
	<?php echo CHtml::encode($data->FirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MiddleName')); ?>:</b>
	<?php echo CHtml::encode($data->MiddleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BirthDate')); ?>:</b>
	<?php echo CHtml::encode($data->BirthDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Gender')); ?>:</b>
	<?php echo CHtml::encode($data->Gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CommandID')); ?>:</b>
	<?php 
        //echo CHtml::encode($data->CommandID); 
        echo CHtml::encode($data->CommandName()); 
    ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('FstID')); ?>:</b>
	<?php echo CHtml::encode($data->FstID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CategoryID')); ?>:</b>
	<?php echo CHtml::encode($data->CategoryID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AttestLevelID')); ?>:</b>
	<?php echo CHtml::encode($data->AttestLevelID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WeigthID')); ?>:</b>
	<?php echo CHtml::encode($data->WeigthID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Coach1ID')); ?>:</b>
	<?php echo CHtml::encode($data->Coach1ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Coach2ID')); ?>:</b>
	<?php echo CHtml::encode($data->Coach2ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MedicSolve')); ?>:</b>
	<?php echo CHtml::encode($data->MedicSolve); ?>
	<br />

	*/ ?>

</div>