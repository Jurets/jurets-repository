<?php
    /* @var $this WeightcategoryController */
    /* @var $dataProvider CActiveDataProvider */

    /*$this->breadcrumbs=array(
    'Weightcategories',
    );

    $this->menu=array(
    array('label'=>'Create Weightcategory', 'url'=>array('create')),
    array('label'=>'Manage Weightcategory', 'url'=>array('admin')),
    );*/

?>

<h1><?php echo $age->AgeName; ?> - весовые категории</h1>

<?php 
    $this->renderPartial('/site/manager');
    $this->breadcrumbs[Yii::t('fullnames', 'Agecategories')] = array('agecategory/index');
    //$this->breadcrumbs[Yii::t('fullnames', 'Weightcategories')] = array('weightcategory/index', 'id'=>$age->AgeID);
    $this->breadcrumbs[$age->AgeName] = array('weightcategory/index', 'id'=>$age->AgeID);

    /*if (Yii::app()->user->isExtendRole()) {
    $actions = CHtml::tag('a', array(
    'href'=>Yii::app()->createUrl('/weightcategory/create', array('id'=>$age->AgeID)),
    'class'=>'btn btn-primary',
    'title'=>Yii::t('fullnames', 'Добавить'),
    'style'=>'margin-top: 20px; margin-bottom: 20px;'
    ), Yii::t('controls','Create'));
    } else {
    $actions = '';
    }*/
    //вывод кнопки добавления
    //echo $actions;

    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
    )); 
    //вывод кнопки добавления
    //echo $actions;
    // вывод вьюшки добавления
    if (Yii::app()->user->isExtendRole()) {
        $model = new Weightcategory;
        $model->AgeID = $age->AgeID;
        $model->ordernum = $model->getMaxOrdernum($model->AgeID) + 1;
        // вывод вьшки формы
        echo $this->renderPartial('_form', array(
            'age'=>$age,
            'model'=>$model,
        )); 

    }   
?>
