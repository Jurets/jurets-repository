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
                '<b>'.Yii::t('controls', 'You are the manager of competition').'</b> '.
                Yii::t('controls', 'You can perform the following operations').':<ul>'.
                '<li>'.Yii::t('controls', 'manage users (team leaders)').'</li>'.
                '<li>'.Yii::t('controls', 'add participants (athletes, coaches)').'</li>'.
                '<li>'.Yii::t('controls', 'delete and edit entered information').'</li></ul>', true);
        } elseif ($model->status == Users::STATUS_NEW) {
            echo CHtml::tag('p', array('class'=>'note'), 
                 Yii::t('controls', 'You have successfully registered.').
                 Yii::t('controls', 'Within a maximum of three days, your registration will be confirmed and indicated on your E-mail will be sent a confirmation letter and registration data.').
                 Yii::t('controls', 'While you can not edit data - wait for confirmation of registration!').
                 Yii::t('controls', 'However, you can apply for the current competition.').
                 '<br>'.Yii::t('controls', 'Below are the personal data you have entered:'), true);
        } 
        elseif ($model->status == Users::STATUS_ACTIVE) {
            echo CHtml::tag('p', array('class'=>'note'), 
                '<b>'.Yii::t('controls', 'Your account is active').'!</b> '.
                Yii::t('controls', 'You can perform the following operations').':<ul>'.
                '<li>'.Yii::t('controls', 'apply for participation in the competition').'</li>'.
                '<li>'.Yii::t('controls', 'edit your personal data').'</li>'.
                '<li>'.Yii::t('controls', 'change your password').'</li></ul>', true);
        } 
    } elseif ($isExtendRole) {
        echo CHtml::tag('p', array('class'=>'note'), 
             'Для управления пользователем воспользуйтесь списком действий из предлагаемого меню.'.
             '<br>Ниже приведены персональные данные Пользователя:', true);  
    }

    //вывести инфо по юзеру в виджете
    $complistContent = $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'complist-grid',
        'dataProvider'=>$dataComplist,
        //'template'=>"{pager}<br>{items}<br>{pager}",
        'template'=>"{items}",
        'columns'=>array(
            array(
                'header'=>Yii::t('fullnames', 'Name'),
                'value'=>'$data["name"]',
            ),
            array(
                'header'=>Yii::t('fullnames', 'Дата начала'),
                'type'=>'date',
                'value'=>'strtotime($data["begindate"])',
            ),
            array(
                'header'=>Yii::t('fullnames', 'Дата окончания'),
                'type'=>'date',
                'value'=>'strtotime($data["enddate"])',
            ),
        ),
    ), true);
    
    //ТабВью: показать данные на вкладках раздельно
    $tabnum = Yii::app()->request->getParam('tab');
    $tabnum = !empty($tabnum) ? $tabnum : 1;
    
    $this->widget('bootstrap.widgets.TbTabs', array(
        //'skin'=>'default',
        'id'=>'usertab',
        'type'=>'tabs', //'pills'
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array(
                'label'=>Yii::t('fullnames', 'Персональные данные'), 
                'content'=>$this->renderPartial('application.views.site._userdata', array('user'=>$model, 'isAccess'=>$isExtendRole), true), 
                'active'=>($tabnum == 1)
            ),
            array(
                'label'=>Yii::t('fullnames', 'Статистика'), 
                'content'=>$complistContent, 
                'active'=>($tabnum == 2)
            ),
        ),
    ));
    
?>
