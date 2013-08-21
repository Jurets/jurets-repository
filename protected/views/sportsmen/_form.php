<?php
/* @var $this SportsmenController */
/* @var $model Sportsmen */
/* @var $form CActiveForm */
Yii::import('application.modules.posting.models.*');

    $isDisabled = (!$extendRole) && (isset($model->CommandID) && !empty($model->CommandID));

?>

<div class="form">

<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'sportsmen-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'well'),
)); 
?>

    <p class="note"><?=Yii::t('fullnames', 'Fields with {asteriks} are required.', array('{asteriks}'=>'<span class="required">*</span>'))?></p>

    <?php 
        //echo $form->errorSummary($model); 
        echo $form->hiddenField($model, 'SpID');
        //echo $form->hiddenField($model, 'SpID');
    
        echo $form->textFieldRow($model,'LastName');
        echo $form->textFieldRow($model,'FirstName',array('size'=>20,'maxlength'=>20));
        echo $form->textFieldRow($model,'MiddleName',array('size'=>20,'maxlength'=>20));
        echo $form->textFieldRow($model,'IdentCode',array('size'=>20,'maxlength'=>20));
        echo $form->dropDownListRow($model, 'BirthDate', $years, 
                                    array('empty' => '<'.Yii::t('controls', 'Choose birth year').'>'
                                    )); 

        echo $form->dropDownListRow($model, 'CommandID', CHtml::listData(Command::model()->findAll(), 'CommandID', 'CommandName'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose command').'>',
                                          'disabled'=>$isDisabled,
                                          'ajax' => array(
                                                'type'=>'POST', //request type
                                                'url'=>CController::createUrl('sportsmen/dynamiccoaches'), //url to call.
                                                'update'=>'.select_coach'), //selector to update
                                    )); 

        echo $form->dropDownListRow($model, 'FstID', CHtml::listData(Fst::getList()/*model()->findAll()*/, 'FstID', 'FstName'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose FST').'>'
                                    )); 
        echo $form->dropDownListRow($model, 'CategoryID', CHtml::listData(Sportcategory::getList() /*model()->findAll()*/, 'CategoryID', 'CategoryName'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose category').'>'
                                    )); 
        echo $form->dropDownListRow($model, 'AttestLevelID', CHtml::listData(Attestlevel::getList()/*model()->findAll()*/, 'AttestLevelID', 'AttestLevel'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose attest level').'>'
                                    )); 

        echo $form->dropDownListRow($model, 'Gender', array('м' => 'мужской', 'ж' => 'женский'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose gender').'>',
                                           'ajax' => array(
                                                'type'=>'POST', //request type
                                                'url'=>CController::createUrl('sportsmen/dynamicages'), //url to call.
                                                'update'=>'#Sportsmen_AgeID', //selector to update
                                    )));
      //возрастные категории  
        $data = Sportsmen::getAgesList($model->Gender);
        echo $form->dropDownListRow($model, 'AgeID', CHtml::listData($data, 'AgeID', 'AgeNameYear'), array(
                                           'empty' => '<'.Yii::t('controls', 'Choose age category').'>',
                                           'ajax' => array(
                                                'type'=>'POST', //request type
                                                'url'=>CController::createUrl('sportsmen/dynamicweights'), //url to call.
                                                'update'=>'#Sportsmen_WeightID', //selector to update
                                           ))); 

      //весовые категории                                     
        $data = Sportsmen::getWeigthsList($model->AgeID);
        echo $form->dropDownListRow($model, 'WeigthID', CHtml::listData($data, 'WeightID', 'WeightName'), array(
                                           'id' => 'Sportsmen_WeightID', 
                                           'empty' => '<'.Yii::t('controls', 'Choose weigth category').'>'
                                           )); 

      //тренеры
        $data = Sportsmen::getCoachList($model->CommandID);
        echo $form->dropDownListRow($model, 'Coach2ID', 
                            CHtml::listData($data, 'CoachID', 'CoachName'), 
                            array('id' => 'Sportsmen_Coach2ID', 
                                  'empty' => '<'.Yii::t('controls', 'Choose coach').'>',
                                  'class' => 'select_coach'));
        echo $form->dropDownListRow($model, 'Coach1ID', 
                            CHtml::listData($data, 'CoachID', 'CoachName'), 
                            array('id' => 'Sportsmen_Coach1ID', 
                                  'empty' => '<'.Yii::t('controls', 'Choose coach').'>',
                                  'class' => 'select_coach'));
        //echo $form->textFieldRow($model,'MedicSolve');

//Форма для загрузки фото ----------------------
//создать форму для загрузки
    $uploadModel = new PPhotoForm;
    $uploadModel->PhotoTitle = 'Фотография';
    $uploadModel->PhotosTitle = 'Фотографии';
    //DebugBreak();
    if(!empty($model->photoid)) {        //if exists post_id (instance of POST)
        //$isTeaserPreload = true;        //set flags for loading photos
        $isPhotosPreloaded = true;
        //$postId = $model->post_id;
    } else 
    {                            //else - do not load photos
        //$postId = '';
        //$isTeaserPreload = isset($titlephotoid); //if exist title photo in params
        $isPhotosPreloaded = isset($photolist);  //if exist photo list in params
        
        //if ($isTeaserPreload) 
        //    $url_title = yii::app()->createUrl('/posting/default/loadphotos',array('id'=>$titlephotoid,'ismain'=>true));

        if ($isPhotosPreloaded) {        
            $idarr = array_keys($photolist);
            $idstr = implode('&', $idarr);
            $url_list = yii::app()->createUrl('/posting/default/loadphotos',array('id'=>$idstr,'ismain'=>false));
        }
    }
    
    //control urls (if not set): set to "postid"-mode
    //if (!isset($url_title))
    //    $url_title = yii::app()->createUrl('/posting/default/loadimages',array('id'=>$postId,'title'=>true));
    if (!isset($url_list))
        $url_list = yii::app()->createUrl('/posting/default/loadportrait', array('id'=>$model->SpID));
        //$url_list = yii::app()->createUrl('/posting/default/loadimages', array('id'=>$postId,'title'=>false));
?>

<hr>

<!--<div style="float: right; width: 200px;">-->
<?php
    //widget for photo uploading
    Yii::app()->controller->widget('application.widgets.PUploadHorizontal',array(
       'url' => Yii::app()->createUrl("/posting/default/uploadportrait"),
       'type' => PUploadHorizontal::TYPE_XUPLOAD,
       'form' => $form, 
       'model' => $uploadModel,
       'uploadView' =>'application.modules.posting.views.default.upload',
       'downloadView' =>'application.modules.posting.views.default.portraitdownload', 
       'downloadTemplate' =>'template-download2',
       'attribute' => 'file',
       'multiple' => false,
       'autoUpload' => false,
       'formView' =>'application.modules.posting.views.default.personphoto',
       'loadStoredData'=>$isPhotosPreloaded,  //flag - if need to load list of photos
       'storedDataUrl'=>$url_list, //url for ajax upload of images (title=false - list of photos)   
       'htmlOptions' => array('id'=>'ufiles'),
    ));    
?>
<!--</div> -->
<?php

//----------------------
        
        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>($model->isNewRecord ? Yii::t('controls', 'Create') : Yii::t('controls', 'Save')), 
            'type'=>'primary',
            'buttonType'=>'submit',
            'htmlOptions'=>array(
                //'data-toggle'=>'modal', 'data-target'=>'#myModal',
                //'data-content'=>$form->errorSummary($model), 
                'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
                ),
        ));    

        echo $form->errorSummary($model); 
    ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
