<?php
/* @var $this AgecategoryController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1><?php echo Yii::t('fullnames', 'Agecategories')?></h1>

<?php 
    $this->renderPartial('/site/manager');
    $this->breadcrumbs['Возрастные категории'] = array('agecategory/index');

    $this->renderPartial('_index', array('dataProvider'=>$dataProvider));
?>
