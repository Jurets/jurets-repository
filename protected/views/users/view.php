<?php
/* @var $this UsersController */
/* @var $model Users */
    
    $isGuest = Yii::app()->isGuestUser; //определить: текущий юзер - гость
    $isExtendRole = Yii::app()->isExtendRole; //если суперюзер
    //определить: если текущий юзер = просматриваемый
    $isMyUserID = (Yii::app()->user->userid == $model->UserID); 
    
  //Вывести путь (хлебные крошки)  
    $this->breadcrumbs=array(
	    //'Users'=>array('index'),
	    //$model->UserID,
        Yii::t('fullnames', 'My Cabinet')
    );

  //если текущий Юзер <> Гость то вывести меню (частичная вью)
    if (!$isGuest) {
        $this->renderPartial('_menu', array(
            'model'=>$model, 
            /*'isGuest'=>$isGuest,
            'isExtendRole'=>$isExtendRole,
            'isMyUserID'=>$isMyUserID*/
        ));
    }
  
  //вывести заголовок: в зависимости от того, какой юзер
    if ($isMyUserID)
        $title_str = Yii::t('fullnames', 'My Cabinet');
    elseif ($isExtendRole)
        $title_str = Yii::t('controls', 'View').': '.Yii::t('fullnames', 'user');
    echo CHtml::tag('h1', array(), $title_str);
  
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

//$proposal = Proposal::model()->findByPk($model->propid);
//$command = Command::model()->find('commandname = :cname', array(':cname'=>$proposal->commandname));
    if ($isMyUserID) {
        if ($isExtendRole) {
            echo CHtml::tag('p', array('class'=>'note'), 
                '<b>Вы являетесь менеджером соревнования.</b> '.
                'Вы можете выполнять следующие операции:<ul>'.
                '<li>управлять пользователями (представителями команд)</li>'.
                '<li>добавлять участников (спортсмены, тренеры)</li>'.
                '<li>удалять и редактировать введенную информацию</li></ul>', true);
        } elseif ($model->status == Users::STATUS_NEW) {
            echo CHtml::tag('p', array('class'=>'note'), 
                 'Вы успешно зарегистрировались. В течение максимум трёх дней Ваша регистрация будет подтверждена и на указаный Вами E-mail будет выслано письмо '.
                 'с подтверждением и регистрационными данными.'.
                 'Пока что Вы не можете редактировать данные - дождитесь подтверждения регистрации!'.
                 'Однако Вы можете подать заявку на текущее соревнование.'.
                 '<br>Ниже приведены введённые Вами персональные данные:', true);
        } 
        elseif ($model->status == Users::STATUS_ACTIVE) {
            echo CHtml::tag('p', array('class'=>'note'), 
                '<b>Ваша учётная запись активна!</b> '.
                'Вы можете выполнять следующие операции:<ul>'.
                '<li>подать заявку на участие в соревновании</li>'.
                '<li>редактировать свои персональные данные</li>'.
                '<li>поменять свой пароль</li></ul>', true);
        } 
    } elseif ($isExtendRole) {
        echo CHtml::tag('p', array('class'=>'note'), 
             'Для управления пользователем воспользуйтесь списком действий из предлагаемого меню.'.
             '<br>Ниже приведены персональные данные Пользователя:', true);  
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
		'UserName',
        'lastname',
        'firstname',
        'federation',
        'post',
        'country',
        'city',
        'club',
        'address',
        'phone',
        'Email',
        'www',
        'comment',
        array(
            'label'=>Yii::t('fullnames', 'Status'),
            'value'=>$model->statusTitle,
        ),
	),
)); 
?>
