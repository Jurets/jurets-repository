<?php
/* @var $this ProposalController */
/* @var $model Proposal */

$this->renderPartial('/site/manager');

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('proposal-grid', {
        data: $(this).serialize()
    });
    return false;
});
");*/
?>

<h1>Предварительная заявка</h1>

<div class="form">
<?php
    echo CHtml::form();

    if (!$model->status) 
        echo CHtml::tag('p', array('class'=>'note'), 'Чтобы подтвердить заявку - нажмите кнопку подтверждения внизу страницы', true);
    else
        echo CHtml::tag('p', array('class'=>'note'), 'Данная заявка подтверждена. Чтобы сгенерировать для данного пользователя новый пароль - нажмите кнопку смены пароля внизу страницы. При этом пользователю на указанный E-mail вышлется письмо с новым паролем', true);
    
    $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'commandname',
        //'lastname',
        //'firstname',
        'country',
        'city',
        'federation',
        'club',
        //'post',
        'address',
        //'phone',
        //'login',
        //'email',
        //'www',
        'participantcount',
        'comment',
        'propid',
        ),
    ));
    
    if (!$model->status)
        echo CHtml::submitButton('Подтвердить заявку',array('name'=>'reg', 'confirm'=>'Вы действительно хотите подтвердить заявку?'));
    else
        echo CHtml::submitButton('Смена пароля',array('name'=>'password', 'confirm'=>'Вы действительно хотите сменить пароль для пользователя?'));
        
    echo CHtml::endForm();
    
?>
</div>
