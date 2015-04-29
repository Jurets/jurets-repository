<?php
/* @var $this AgecategoryController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1><?php echo Yii::t('fullnames', 'Agecategories')?></h1>

<?php 
    $this->renderPartial('/site/manager');
    $this->breadcrumbs['Возрастные категории'] = array('agecategory/index');

    $this->renderPartial('_index', array('dataProvider'=>$dataProvider));
    
    if (Yii::app()->user->isExtendRole()) {
        /*echo CHtml::tag('a', array(
            'href'=>Yii::app()->createUrl('/competition/update'),
            'class'=>'btn btn-primary',
            'title'=>Yii::t('fullnames', 'Изменить параметры соревнования')
        ), Yii::t('controls','Update'));
     
        //эксопрт в CSV
        echo CHtml::tag('a', array(
            'href'=>Yii::app()->createUrl('/competition/exportcsv'),
            'class'=>'btn btn-primary',
            'title'=>Yii::t('fullnames', 'Экспорт данных в CSV-файл'),
            'style'=>'margin-left: 20px;'
        ), Yii::t('controls','Экспорт')); */
        
        echo CHtml::tag('a', array(
            'href'=>Yii::app()->createUrl('/agecategory/create'),
            'class'=>'btn btn-primary',
            'title'=>Yii::t('fullnames', 'Добавить'),
            'style'=>'margin-left: 60px;'
        ), Yii::t('controls','Create'));
        
    }
    
?>
