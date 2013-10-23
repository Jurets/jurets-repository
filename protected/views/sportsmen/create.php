<?php
/* @var $this SportsmenController */
/* @var $model Sportsmen */

$this->breadcrumbs = $crumbs;

$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
));

?>

<h1><?php echo Yii::t('controls', 'Create').': '.Yii::t('fullnames', 'sportsmen'); ?></h1>

<?php 
echo $this->renderPartial('_form', array(
    'model'=>$model,
    'extendRole'=>$extendRole,
    'years'=>$years,
)); 
?>