<div class="form">
<?php
/*    
    if (Yii::app()->user->isExtendRole()) 
        echo CHtml::tag('p', array('class'=>'note'), 'Чтобы изменить параметры соревнования - нажмите ссылку внизу страницы', true);
*/
    $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'nullDisplay'=>'<span class="null">'.Yii::t('fullnames', 'no data').'</span>',
    'attributes'=>array(
        'name',
        'title',
        'begindate',
        'enddate',
        'place',
        'courtcount',
        'maxparticipants',
        //'isfiling',
        'filingbegin',
        'filingend',
        ),
    )); 

/*    if (Yii::app()->user->isExtendRole()) 
        echo CHtml::tag('a', array('href'=>Yii::app()->createUrl('/competition/update')), 'Редактировать');
*/    
?>
</div>
