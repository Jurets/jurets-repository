<?php
/* @var $this PostingController */
/* @var $model Posting */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'posting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('fullnames', 'Fields with {asteriks} are required.', array('{asteriks}'=>'<span class="required">*</span>'))?></p>
    
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_description'); ?>
		<?php echo $form->textArea($model,'meta_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'meta_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_create'); ?>
		<?php echo $form->textField($model,'date_create'); ?>
		<?php echo $form->error($model,'date_create'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teaser'); ?>
		<?php echo $form->textField($model,'teaser',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'teaser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->DropDownList($model, 'is_active', array('0' => 'да', '1' => 'нет'));?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

<!--
    <div class="row">
        <?php echo $form->labelEx($model,'post_type'); ?>
        <?php echo $form->textField($model,'post_type',array('size'=>1,'maxlength'=>1)); ?>
        <?php echo $form->error($model,'post_type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'num_comments'); ?>
        <?php echo $form->textField($model,'num_comments',array('size'=>11,'maxlength'=>11)); ?>
        <?php echo $form->error($model,'num_comments'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'t_photo_id'); ?>
        <?php echo $form->textField($model,'t_photo_id',array('size'=>11,'maxlength'=>11)); ?>
        <?php echo $form->error($model,'t_photo_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'like_count'); ?>
        <?php echo $form->textField($model,'like_count',array('size'=>11,'maxlength'=>11)); ?>
        <?php echo $form->error($model,'like_count'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'informer_title'); ?>
		<?php echo $form->textField($model,'informer_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'informer_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'show_gallery'); ?>
		<?php echo $form->textField($model,'show_gallery'); ?>
		<?php echo $form->error($model,'show_gallery'); ?>
	</div>

-->	

<hr>

<?php
//создать форму для загрузки
/*    $uploadModel = new PPhotoForm;
    $uploadModel->PhotoTitle = 'Главная фотография';
    $uploadModel->PhotosTitle = 'Фотографии';
    if(!empty($model->post_id)) {        //if exists post_id (instance of POST)
        $isTeaserPreload = true;        //set flags for loading photos
        $isPhotosPreloaded = true;
        $postId = $model->post_id;
    } else {                            //else - do not load photos
        $postId = '';
        $isTeaserPreload = isset($titlephotoid); //if exist title photo in params
        $isPhotosPreloaded = isset($photolist);  //if exist photo list in params
        
        if ($isTeaserPreload) 
            $url_title = yii::app()->createUrl('/posting/default/loadphotos',array('id'=>$titlephotoid,'ismain'=>true));

        if ($isPhotosPreloaded) {        
            $idarr = array_keys($photolist);
            $idstr = implode('&', $idarr);
            $url_list = yii::app()->createUrl('/posting/default/loadphotos',array('id'=>$idstr,'ismain'=>false));
        }
    }
    
    //control urls (if not set): set to "postid"-mode
    if (!isset($url_title))
        $url_title = yii::app()->createUrl('/posting/default/loadimages',array('id'=>$postId,'title'=>true));
    if (!isset($url_list))
        $url_list = yii::app()->createUrl('/posting/default/loadimages',array('id'=>$postId,'title'=>false));

    //widget for photo uploading
    Yii::app()->controller->widget('application.widgets.PUploadHorizontal',array(
       'url' => Yii::app()->createUrl("/posting/default/uploads"),
       'type' => PUploadHorizontal::TYPE_XUPLOAD,
       'form' => $form, 
       'model' => $uploadModel,
       'uploadView' =>'application.modules.posting.views.default.upload',
       'downloadView' =>'application.modules.posting.views.default.photodownloads', 
       'downloadTemplate' =>'template-download2',
       'attribute' => 'files',
       'multiple' => true,
       'autoUpload' => false,
       'formView' =>'application.modules.posting.views.default.titleform',
       'loadStoredData'=>$isPhotosPreloaded,  //flag - if need to load list of photos
       'storedDataUrl'=>$url_list, //url for ajax upload of images (title=false - list of photos)   
       'htmlOptions' => array('id'=>'ufiles'),
    )); */   
    
    
    
    //widget for main photo uploading
$this->beginWidget('bootstrap.widgets.TbModal', array(
    'id'=>'myModal',
    'fade'=>false,
    'options'=>array('backdrop'=>false),
)); 
?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
</div>
 
<div class="modal-body">
    <p>One fine body...</p>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Save changes',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 

<?php 
$this->endWidget();    
    
/*$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Click me',
    'type'=>'primary',
    'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#myModal',
    ),
));*/    
?>


    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('controls', 'Create') : Yii::t('controls', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->