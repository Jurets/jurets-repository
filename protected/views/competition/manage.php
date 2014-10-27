<?php
/* @var $this CompetitionController */
/* @var $model Competition */
?>

<h3><?php echo Yii::t('controls', 'View').': '.Yii::t('fullnames', 'Competition'); ?></h3>

<?php
$this->renderPartial('/site/manager');
    
echo CHtml::form();
    if (Yii::app()->user->isExtendRole()) 
        echo CHtml::tag('p', array('class'=>'note'), Yii::t('fullnames', Yii::t('controls', 'To change Competition params - click reference bolow')), true);

    $this->renderPartial('_view', array('model'=>$model));

    if (Yii::app()->user->isExtendRole()) {
        echo CHtml::tag('a', array(
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
        ), Yii::t('controls','Экспорт'));
        
        echo CHtml::tag('a', array(
            'href'=>Yii::app()->createUrl('/competition/create'),
            'class'=>'btn btn-primary',
            'title'=>Yii::t('fullnames', 'Создать новое соревнование'),
            'style'=>'margin-left: 60px;'
        ), Yii::t('controls','Create'));
        
    }
        
    $this->renderPartial('_stat', array('dataStat'=>$dataStat));
echo CHtml::endForm();
    
?>