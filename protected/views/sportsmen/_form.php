<?php
/* @var $this SportsmenController */
/* @var $model Sportsmen */
/* @var $form CActiveForm */
Yii::import('application.modules.posting.models.*');

$isDisabled = (!$extendRole) && (isset($model->CommandID) && !empty($model->CommandID));
//объект соревнования
$competition = Competition::getModel();
?>

<div class="form">

<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'sportsmen-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'well'),
)); 
        // вьюшка "обязательноть полей"
        $this->viewFieldsReq();
 
        //все возрастные и весовые (сразу - жадная загрузка)
        //$ages = Agecategory::getAges();
        //$ages = Agecategory::model()->with('relWeigths')->findAll();
        
        //показать ошибки
        echo $form->errorSummary($model); 
        
        echo $form->hiddenField($model, 'SpID');
        echo $form->textFieldRow($model,'LastName');
        echo $form->textFieldRow($model,'FirstName',array('size'=>20,'maxlength'=>20));
        echo $form->textFieldRow($model,'MiddleName',array('size'=>20,'maxlength'=>20));
        echo $form->textFieldRow($model,'IdentCode',array('size'=>20,'maxlength'=>20));
        echo $form->dropDownListRow($model, 'CommandID', CHtml::listData(Command::model()->competition()->findAll(), 'CommandID', 'CommandName'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose command').'>',
                                          'disabled'=>$isDisabled,
                                          'ajax' => array(
                                                'type'=>'POST', //request type
                                                'url'=>CController::createUrl('sportsmen/dynamiccoaches'), //url to call.
                                                'update'=>'.select_coach'), //selector to update
                                    )); 
        echo $form->hiddenField($model, 'Gender');
        
      //возрастные категории  
        $age_array = array();
        if ($competition->isCompetition) {  //обычное соревнование WTF
            // поле года рождения
            echo $form->dropDownListRow($model, 'BirthDate', $years, array(
                'empty' => '<'.Yii::t('controls', 'Choose birth year').'>',
                'id' => 'Sportsmen_BirthDate', 
            ));
            if (isset($model->BirthDate)) {                  //получить возрастные
                $date = strtotime($model->BirthDate);        //по году рождения
                $year = date("Y", $date);
                foreach($ages as $age) {
                    if ($age->YearMin <= $year && $year <= $age->YearMax)
                        $age_array[] = $age;
                }
            }
            $age_array = CHtml::listData($age_array, 'AgeID', 'AgeNameYear');
            $readonly = !isset($model->BirthDate) || empty($model->BirthDate);
        } else { // ------ для версии ITF
            // поле "полный возраст"
            echo $form->dropDownListRow($model, 'fullyears', $years, array(
                'empty' => '<'.Yii::t('controls', 'Choose full years').'>',
                'id' => 'Sportsmen_fullyears', 
            ));
            //echo $form->textFieldRow($model, 'fullyears', array('size'=>3,'maxlength'=>3));
            
            foreach($ages as $age) {
                $age_array[] = $age;
            }
            $age_array = CHtml::listData($age_array, 'AgeID', 'AgeNameYearShort');
            $readonly = !isset($model->fullyears) || empty($model->fullyears);
        }
        
        echo $form->dropDownListRow($model, 'AgeID', $age_array, array(
            'empty' => '<'.Yii::t('controls', 'Choose age category').'>',
            'readonly'=>$readonly //true,
        )); 
        
      //весовые категории                                     
        $data = Sportsmen::getWeigthsList($model->AgeID);
        $weigths = CHtml::listData($data, 'WeightID', 'WeightNameFull');
        if ($competition->isCamp) { //если СБОРЫ - то скрытое поле весовой категории
            echo $form->hiddenField($model, 'WeigthID', array('id' => 'Sportsmen_WeightID'));
        } else { //иначе показать выпадающий список весовой категории
            if ($competition->type == 'itf') {
                $weigths = CMap::mergeArray(array(-1=>'нет'), $weigths);
            }
            echo $form->dropDownListRow($model, 'WeigthID', $weigths, array(
               'id' => 'Sportsmen_WeightID', 
               'empty' => '<'.Yii::t('controls', 'Choose weigth category').'>',
               'readonly'=>!isset($model->AgeID) || empty($model->AgeID), //true,
            )); 
        }
        
        // дополнительное поле ТУЛЬ
        if ($competition->type == 'itf') {
            //echo $form->checkBoxRow($model, 'tul', array());
            echo CHtml::tag('div', array('class'=>'control-group'), 
                CHtml::label('Личный туль', 'Sportsmen_persontul', array('class'=>'control-label')) .
                CHtml::tag('div', array('class'=>'controls'), 
                    CHtml::activeCheckBox($model, 'persontul', array('id'=>'Sportsmen_persontul'))
                )
            );
        }
                                                                       
        echo $form->dropDownListRow($model, 'FstID', CHtml::listData(Fst::getList(), 'FstID', 'FstName'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose FST').'>'
                                    )); 
        echo $form->dropDownListRow($model, 'CategoryID', CHtml::listData(Sportcategory::getList() , 'CategoryID', 'CategoryName'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose category').'>'
                                    )); 
        echo $form->dropDownListRow($model, 'AttestLevelID', CHtml::listData(Attestlevel::getList(), 'AttestLevelID', 'AttestLevel'), 
                                    array('empty' => '<'.Yii::t('controls', 'Choose attest level').'>'
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
    if (!isset($url_list)) {
        //$url_list = yii::app()->createUrl('/posting/default/loadportrait', array('id'=>$model->SpID,'title'=>false));
        $url_list = yii::app()->createUrl('/posting/default/loadportrait', array('photoid'=>$model->photoid));
    }
?>

<hr>

<!--<div style="float: right; width: 200px;">-->
<?php
    //widget for photo uploading
    Yii::app()->controller->widget('application.widgets.PUploadHorizontal',array(
       'url' => Yii::app()->createUrl("/postupload"),
       'type' => PUploadHorizontal::TYPE_XUPLOAD,
       'form' => $form, 
       'model' => $uploadModel,
       'uploadView' =>'application.modules.posting.views.default.upload',
       'downloadView' =>'application.modules.posting.views.default.portraitdownload', 
       'downloadTemplate' =>'template-download2',
       'attribute' => 'file',
       'multiple' => false,
       'autoUpload' => true,
       'formView' =>'application.modules.posting.views.default.personphoto',
       'loadStoredData'=>$isPhotosPreloaded,  //flag - if need to load list of photos
       'storedDataUrl'=>$url_list, //url for ajax upload of images (title=false - list of photos)   
       'htmlOptions' => array('id'=>'ufiles'),
    ));    
    
    
////// альтернвтивный новый вариант виджета
    /*$this->widget('ext.imageAttachment.ImageAttachmentWidget', array(
        'model' => $model,
        'behaviorName' => 'preview',
        'apiRoute' => 'sportsmen/saveImageAttachment',
    ));*/    
    
    
?>
<!--</div> -->
<?php
        //---------------------- Кнопки
        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>Yii::t('controls', 'Save'),
            'type'=>'primary',
            'buttonType'=>'submit',
            'htmlOptions'=>array(
                'name'=>'save_exit',
                'title'=>($model->isNewRecord ? Yii::t('controls', 'Добавить спортсмена') : Yii::t('controls', 'Сохранить изменения')),
                'style'=>'margin-left: 20px;',
                'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
            ),
        ));        

        if ($model->isNewRecord) {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>Yii::t('controls', 'Сохранить + новый'), 
                'type'=>'primary',
                'buttonType'=>'submit',
                'htmlOptions'=>array(
                    'name'=>'save_new',
                    'title'=>Yii::t('controls', 'Сохранить изменения и Добавить нового спортсмена'),
                    'style'=>'margin-left: 20px;',
                    'onclick'=>'$("#Sportsmen_CommandID").attr("disabled", false)',
                ),
            ));        
        }
        
        
        
        
$this->endWidget(); //form
?>

<?php 
//подготовить данные для формы

    //год рождения
    foreach($years as $db=>$year) {
        $age_array = array();
        foreach($ages as $age) {
            if ($age->YearMin <= $year && $year <= $age->YearMax)
                $age_array[] = $age;
        }
        //возрастные категории
        $age_array = CHtml::listData($age_array, 'AgeID', 'AgeNameYear');
        $age_array = CMap::mergeArray(array('' => '<'.Yii::t('controls', 'Choose age category').'>'), $age_array);
        //$age_array = CMap::mergeArray(array('empty' => '<'.Yii::t('controls', 'Choose age category').'>'), $age_array);
        echo CHTML::dropDownList('ages_byyear_' . $year, null, $age_array, array('style'=>'display: none'));
    }
    
    //весовые категории - по возрастным
    foreach($ages as $age) {
        $weigths = $age->relWeigths;
        $weigths = CHtml::listData($weigths, 'WeightID', 'WeightNameFull');
        //$weigths = CMap::mergeArray(array('empty' => '<'.Yii::t('controls', 'Choose weigth category').'>'), $weigths);
        if ($competition->type == 'itf') {
            $weigths = CMap::mergeArray(array(-1=>'нет'), $weigths);
        }
        $weigths = CMap::mergeArray(array('' => '<'.Yii::t('controls', 'Choose weigth category').'>'), $weigths);
        echo CHTML::dropDownList('weigths_fromage_' . $age->AgeID, null, $weigths, array('style'=>'display: none'));
    }
    
    $js = '$("#Sportsmen_BirthDate").change(function() {
                year_elem = $("#ages_byyear_" + $(this).children(":selected").text());
                age_elem = $("#Sportsmen_AgeID");
                age_elem.html(year_elem.html());
                age_elem.attr("readonly", false);
                weigth_elem = $("#Sportsmen_WeightID");
                weigth_elem.attr("readonly", true);
                weigth_elem.html("<option value=\"\"><Выберите весовую категорию></option>");
           })';
           
    //разные обработчики, если соревнование является сборами (весовая категория ставится по умолчанию) КОСТЫЛЬ!!!
    if ($competition->isCamp) {
         $js = '
               $("#Sportsmen_BirthDate").change(function() {
                    year_elem = $("#ages_byyear_" + $(this).children(":selected").text());
                    age_elem = $("#Sportsmen_AgeID");
                    age_elem.html(year_elem.html());
                    age_elem.attr("readonly", false);
               });
               
               $("#Sportsmen_AgeID").change(function() {
                    val = $(this).val();
                    id = "weigths_fromage_" + val;
                    age_elem = $("#" + id);
                    weigth_elem = $("#Sportsmen_WeightID");
                    elem = age_elem.children("option").eq(1); //второй эл-т в списке
                    value = elem.val();
                    weigth_elem.val(value);
               })
               ';
    } else {
         $js = '
               $("#Sportsmen_AgeID").change(function() {
                    val = $(this).val();
                    id = "weigths_fromage_" + val;
                    age_elem = $("#" + id);
                    weigth_elem = $("#Sportsmen_WeightID");
                    weigth_elem.html(age_elem.html());
                    weigth_elem.attr("readonly", false);
               })
               ';
         if ($competition->isCompetition) {
            $js .= '
               $("#Sportsmen_BirthDate").change(function() {
                    year_elem = $("#ages_byyear_" + $(this).children(":selected").text());
                    age_elem = $("#Sportsmen_AgeID");
                    age_elem.html(year_elem.html());
                    age_elem.attr("readonly", false);
                    weigth_elem = $("#Sportsmen_WeightID");
                    weigth_elem.attr("readonly", true);
                    weigth_elem.html("<option value=\"\"><Выберите весовую категорию></option>");
               });
            ';
         } else { // for ITF
            $js .= '
               $("#Sportsmen_fullyears").change(function() {
                    age_elem = $("#Sportsmen_AgeID");
                    age_elem.attr("readonly", false);
                    weigth_elem = $("#Sportsmen_WeightID");
                    weigth_elem.attr("readonly", true);
                    weigth_elem.html("<option value=\"\"><Выберите весовую категорию></option>");
               });
            ';
         }
    }
    Yii::app()->clientScript->registerScript('category_dropdown', $js, CClientScript::POS_READY);
?>

</div>
