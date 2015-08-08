<?php
    /**
    * Partial View: отображение информации по юзеру
    * 
    * @var mixed
    */
    $isAccess = isset($isAccess) ? $isAccess : false;
    
    $attributes = array(
        'lastname', 
        'firstname', 
        'RoleID', 
        'federation', 
        'post', 
        'country', 
        'city', 
        'club', 
        'address', 
        'phone', 
        array(
            'name'=>'created',
            'value'=>strtotime($user->created), 
            'type'=>'date'
        ),
    );
    if ($isAccess) { //если админ или своя команда - добавить поля, скрываемые для других
        if (Yii::app()->controller->id == 'users' && Yii::app()->controller->action->id == 'view') {
            $value = $user->UserName;
        } else {
            if (Yii::app()->isExtendRole) {
                $value = CHtml::link($user->UserName, Yii::app()->createAbsoluteUrl('/users/view', array('id'=>$user->UserID)));
            } else {
                $value = $user->UserName;
            }
        }
        $username = array(
            'name' => 'UserName',
            'type' => 'html',
            'value' => $value,
        );
        array_unshift($attributes, $username);
        $attributes = array_merge($attributes, array('Email','www','comment', 'UserID'));
    }
    //добавить лабел статуса
    $this->widget('bootstrap.widgets.TbLabel', array(
            // 'success', 'warning', 'important', 'info' or 'inverse'
            'type'=>$user->statusCss,  
            'label'=>$user->statusTitle,
        ));
    
    $this->widget('bootstrap.widgets.TbDetailView', array(
            'data'=>$user,
            'nullDisplay'=>'<span class="null">'.Yii::t('fullnames', 'no data').'</span>',
            'attributes'=>$attributes,
        ));   
?>