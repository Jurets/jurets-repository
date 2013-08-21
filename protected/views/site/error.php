<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
    //'Спортсмены'=>array('sportsmen/index'),
	Yii::t('fullnames', 'Error').' '.$code,
);
?>

<h2 style="color: maroon"><?php echo Yii::app()->params['errorcodes'][$code]; ?></h2>

<div class="error">
<?php 
    echo CHtml::encode($message); 
   // echo $this->createUrl('sportsmen/index', array());
?>
</div>