<?php
/* @var $this AgecategoryController */
/* @var $model Agecategory */
?>

<h1><?php echo Yii::t('controls', 'Update') . ': ' . $model->AgeName; ?></h1>

<?php 
    $this->renderPartial('/site/manager');
    $this->breadcrumbs['Возрастные категории'] = array('agecategory/index');
    
    echo $this->renderPartial('_form', array('model'=>$model)); 
?>