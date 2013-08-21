<?php
/* @var $this PostingController */
/* @var $data Posting */

$urlview = Yii::app()->createAbsoluteUrl('posting/default/show', array('id'=>$data->post_id));
$urledit = Yii::app()->createAbsoluteUrl('posting/default/update', array('id'=>$data->post_id));
$urldel  = Yii::app()->createAbsoluteUrl('posting/default/delete', array('id'=>$data->post_id, 'ajax'=>true));

//Определить - с расширенной ли ролью (admin, manager) текущий пользователь
$isExtendRole = Yii::app()->user->isExtendRole();

$photo = TitlePhoto::model()->find('post_id = :post_id', array(':post_id'=>$data->post_id));
?>

<div class="view" style="overflow: hidden;">

    <div style="float: left; margin-right: 20px;">
        <a href="#" onclick="popUp('<?=$urlview?>');return false">
            <?php 
                if (isset($photo->pfilesize)) {
                    $publicPath = Yii::app()->getBaseUrl(true).'/uploads/';
                    $url = $publicPath.basename($photo->thumb_filename/*$data->photo->thumb_filename*/);
                } else
                    $url = $photo->thumb_filename;
                echo CHtml::image($url, 'Фото', array('width'=>'145', 'height'=>'100'));
            ?>
        </a>
    </div>
    
    <?php if ($isExtendRole) { ?>
        <div style="float: right; margin-right: 20px;">
            <!--<div id="myDiv" class="loading" style="float: left;"></div>-->
          <div id="control_<?=$data->post_id?>">
            <a class="btn btn-mini" href="<?=$urledit?>">
                <i class="icon-pencil"></i> 
                <?php echo Yii::t('controls', 'Update')?>
            </a> 
            <br>
            <br>
            <a class="btn btn-mini delete" id="delete_<?=$data->post_id?>" href="#" url="<?=$urldel?>" control="control_<?=$data->post_id?>">
                <i class="icon-trash"></i>  
                <?php echo Yii::t('controls', 'Delete')?>
            </a>
          </div>  
        </div>    
    <?php } ?>
    
	<?php echo CHtml::link(CHtml::encode($data->title), array('#'), array('onclick'=>'popUp("'.$urlview.'");return false')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_description')); ?>:</b>
	<?php echo CHtml::encode($data->meta_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_create')); ?>:</b>
	<?php echo CHtml::encode($data->date_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_comments')); ?>:</b>
	<?php echo CHtml::encode($data->num_comments); ?>
	<br />

    <?php if ($isExtendRole) { ?>
        <a href="<?=Yii::app()->createAbsoluteUrl('posting/default/view', array('id'=>$data->post_id))?>" style="font-size: 10px;"><?=Yii::t('fullnames', 'More information')?></a>
    <?php } ?>
    
<!--    <b><?php echo CHtml::encode($data->getAttributeLabel('post_id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->post_id), array('view', 'id'=>$data->post_id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('post_type')); ?>:</b>
    <?php echo CHtml::encode($data->post_type); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('t_photo_id')); ?>:</b>
	<?php echo CHtml::encode($data->t_photo_id); ?>
	<br />
-->
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('teaser')); ?>:</b>
	<?php echo CHtml::encode($data->teaser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('like_count')); ?>:</b>
	<?php echo CHtml::encode($data->like_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('informer_title')); ?>:</b>
	<?php echo CHtml::encode($data->informer_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('show_gallery')); ?>:</b>
	<?php echo CHtml::encode($data->show_gallery); ?>
	<br />

	*/ ?>

</div>