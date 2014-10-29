<?php
    /**
    * Partial View: отображение информации по юзеру
    * 
    * @var mixed
    */
    $isAccess = isset($isAccess) ? $isAccess : false;
    
    $attributes = array(
        array(
            'name'=>'created',//Yii::t('fullnames', 'Date Create'),
            'value'=>strtotime($user->created), 
            'type'=>'date'
        ),
        'lastname', 
        'firstname', 
        'federation', 
        'post', 
        'country', 
        'city', 
        'club', 
        'address', 
        'phone', 
    );
    if (Yii::app()->controller->id == 'users' && Yii::app()->controller->action->id == 'view')
        $value = $user->UserName;
    else
        $value = CHtml::link($user->UserName, Yii::app()->createAbsoluteUrl('/users/view', array('id'=>$user->UserID)));
    if ($isAccess) { //если админ или своя команда - добавить поля, скрываемые для других
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
            //'type'=>($model->status == Users::STATUS_NEW ? 'warning' : ($model->status == Users::STATUS_NOACTIVE ? 'important' : 'success')),
            'label'=>$user->statusTitle,
            //'htmlOptions'=>('')
        ));
    
    $this->widget('bootstrap.widgets.TbDetailView', array(
            'data'=>$user,
            'nullDisplay'=>'<span class="null">'.Yii::t('fullnames', 'no data').'</span>',
            'attributes'=>$attributes,
        ));   
?>