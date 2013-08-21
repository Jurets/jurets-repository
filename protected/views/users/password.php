<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Users')=>array('index'),
    $model->UserID=>array('view','id'=>$model->UserID),
    'Update',
);

$this->renderPartial('_menu', array('model'=>$model));
?>

<h1><?php echo Yii::t('controls', 'Change Password').': '.Yii::t('fullnames', 'user'); ?></h1>

<?php echo $this->renderPartial('_password', array('model'=>$model)); ?>