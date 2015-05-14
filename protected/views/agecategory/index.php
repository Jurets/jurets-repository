<?php
/* @var $this AgecategoryController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1><?php echo Yii::t('fullnames', 'Agecategories')?></h1>

<?php 
    $this->renderPartial('/site/manager');
    $this->breadcrumbs['Возрастные категории'] = array('agecategory/index');

    if (Yii::app()->user->isExtendRole()) {
        $actions = CHtml::tag('a', array(
            'href'=>Yii::app()->createUrl('/agecategory/create'),
            'class'=>'btn btn-primary',
            'title'=>Yii::t('fullnames', 'Добавить'),
            'style'=>'margin-left: 60px;'
        ), Yii::t('controls','Create'));
    } else {
        $actions = '';
    }
    //вывод кнопки добавления
    //echo $actions;  
    // вывести список возрастных категорий
    $this->renderPartial('_index', array('dataProvider'=>$dataProvider));
    
?>
<br>
<?php 
    //вывод кнопки добавления
    echo $actions; 
?>
<br>
<br>