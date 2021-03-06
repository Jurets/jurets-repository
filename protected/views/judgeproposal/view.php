<?php
/* @var $this ProposalController */
/* @var $model Proposal */

//
$isMyUserID = (Yii::app()->user->userid == $model->judge->userid); 
$isExtendRole = Yii::app()->isExtendRole; 
//$isProposalExists = isset($proposal);

    //определение - есть ли заявка пользователя на соревнование
    //if ($isMyUserID || $isExtendRole) {
    //    $proposal = Proposal::model()->proposalForCompetition(0, $model->userid);
    //    $isProposalExists = isset($proposal);
    //}


if ($isExtendRole)
    $this->breadcrumbs=array(
        Yii::t('fullnames', 'Competition Manager') => array('competition/manager'),
        Yii::t('fullnames', 'Proposals')=>array('/judgeproposal/index'),
        //'Заявки'=>array('index'),
	    $model->judge->user->userFIO,
    );
else
    $this->breadcrumbs=array(
        Yii::t('fullnames', 'My Cabinet')=>array('/users/mycabinet'),
        //'Заявки'=>array('index'),
        $model->judge->user->userFIO,
        //$model->relCommand->CommandName,
    );

$this->menu=array(
    array('label'=>Yii::t('controls', 'Confirm'), 'url'=>'#', 'icon'=>'ok',
        'linkOptions'=>array(
            'submit'=>array('confirm','id'=>$model->id),
            'confirm'=>Yii::t('controls', "Are you sure you want to confirm {item}\n{name}?", array(
                '{item}'=>Yii::t('fullnames', ' proposal'), 
                '{name}'=>$model->judge->user->UserFIO
                )),
            'title'=>'Подтвердить заявку'
            ),
        'visible'=>(!$isMyUserID && $isExtendRole && ($model->status <> JudgeProposal::STATUS_ACTIVE)),
        ),

    array('label'=>Yii::t('controls', 'Cancel'), 'url'=>'#', 'icon'=>'ok',
        'linkOptions'=>array(
            'submit'=>array('cancel','id'=>$model->id),
            'confirm'=>Yii::t('controls', "Are you sure you want to {operation} {item}\n{name}?", array(
                '{item}'=>Yii::t('fullnames', ' proposal'), 
                '{name}'=>$model->judge->user->UserFIO,
                '{operation}' => Yii::t('controls', 'to cancel'),
                )),
            'title'=>'Отменить заявку',
            ),
        'visible'=>(!$isMyUserID && $isExtendRole && ($model->status == JudgeProposal::STATUS_ACTIVE)),
        ),
        
    array('label'=>Yii::t('controls', 'Delete'), 'url'=>'#', 'icon'=>'trash',
        'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->id),
            'confirm'=>Yii::t('controls', "Are you sure you want to delete {item}\n{name}?", array(
                '{item}'=>Yii::t('fullnames', ' proposal'), 
                '{name}'=> "судья: " . $model->judge->user->UserFIO,
            )),
            'title'=>'Удалить заявку'
        ),
        'visible'=>($isMyUserID || $isExtendRole) && ($model->status == JudgeProposal::STATUS_NEW),
    ),
    
    /*array('label'=>Yii::t('controls', Yii::t('fullnames', 'Редактировать команду')),
        'url'=>array('/command/view', 'id'=>$model->commandid),
        'icon'=>'list', 
        'linkOptions'=>array(
            'title'=>'Ввод данных своей команды (тренеры, спортсмены)', //Yii::t('fullnames', Yii::t('fullnames', 'Entering list of sportsmen')), 
        ),
        'visible'=>($isMyUserID&& $model->status == Proposal::STATUS_ACTIVE),
    ),*/
    
);

?>
<h1>Информация о заявке: <?php /*echo $model->propid;*/ ?></h1>

<?php

  //компонент показа всплывающих сообщений (Алерт)  
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true/*, 'closeText'=>'&times;'*/), // success, info, warning, error or danger
            'error'=>array('block'=>true, 'fade'=>true), 
            'warning'=>array('block'=>true, 'fade'=>true), 
        ),
    ));

//подсказка в зависимости от текущего юзера и активности его    
if ($isMyUserID) {
    if ($model->status == JudgeProposal::STATUS_NEW) {
        echo CHtml::tag('p', array('class'=>'note'), 'Вы подали заявку на соревнование. В течение трёх дней она будет подтверждена и на указаный Вами E-mail будет выслано письмо с подтверждением и регистрационными данными.<br>Ниже приведены данные о заявке:', true);
    } else if ($model->status == Proposal::STATUS_ACTIVE){
        echo CHtml::tag('p', array('class'=>'note'), '<b>Ваша заявка подтверждена!</b> '.
        'Вы можете выполнять следующие операции:<ul>'.
        '<li>добавлять участников (спортсмены, тренеры)</li>'.
        '<li>удалять и редактировать введенную информацию</li>', true);
    } 
} elseif ($isExtendRole) {
    echo CHtml::tag('p', array('class'=>'note'), 
         'Для управления заявкой воспользуйтесь списком действий из предлагаемого меню.'.
         //'Сейчас Вы можете редактировать введённые персональные данные, но пока не можете'
         '<br>Ниже приведены данные о заявке:', true);  
}

$this->widget('bootstrap.widgets.TbLabel', array(
    // 'success', 'warning', 'important', 'info' or 'inverse'
    'type'=>$model->statusCss,  
    //'type'=>($model->status == Users::STATUS_NEW ? 'warning' : ($model->status == Users::STATUS_NOACTIVE ? 'important' : 'success')),
    'label'=>$model->statusTitle,
    //'htmlOptions'=>('')
));

$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    'nullDisplay'=>'<span class="null">'.Yii::t('fullnames', 'no data').'</span>',
	'attributes'=>array(
        array(
            'label'=>Yii::t('fullnames', 'Delegate'),
            'value'=>$model->judge->user->UserFIO,
        ),
        /*array(
            'label'=>Yii::t('fullnames', 'Command'),
            'value'=>$model->relCommand->CommandName,
        ),
        'country',
        'city',
        'federation',
        'club',*/
		//'post',
		//'address',
		//'phone',
        //'login',
		//'email',
		///////'participantcount',
        'comment',
		array(
            'name'=>'created',
            'type'=>'datetime',
            'value'=>strtotime($model->created),
        ),
        'id',
	),
)); 

?>