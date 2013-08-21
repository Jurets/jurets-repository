<?php
/* @var $this CommandController */
/* @var $data Command */
?>

<div class="view">
<!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('CommandID')); ?>:</b>
	   <?php echo CHtml::link(CHtml::encode($data->CommandID), array('view', 'id'=>$data->CommandID)); ?>
	<br />
-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('CommandName')); ?>:</b>
	<?php 
        //echo CHtml::encode($data->CommandName); 
        echo CHtml::link(CHtml::encode($data->CommandName), array('view', 'id'=>$data->CommandID));
    ?>
	<br />


</div>