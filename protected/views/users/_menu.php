<?php

$isGuest = Yii::app()->isGuestUser; //определить: текущий юзер - гость

//если текущий юзер не гость - то вывести меню для управления
if (!$isGuest) 
{
    //определить: если суперюзер
    $isExtendRole = Yii::app()->isExtendRole; 
    //определить: если текущий юзер = просматриваемый
    $isMyUserID = (Yii::app()->user->userid == $model->UserID); 
    //определение - есть ли заявка пользователя на соревнование
    if ($isMyUserID || $isExtendRole) {
        $proposal = Proposal::model()->proposalForCompetition(Yii::app()->competitionId, $model->UserID);
    }
    $isProposalExists = isset($proposal);
    if ($isProposalExists) {
        $isProposalActive = $proposal->status == Proposal::STATUS_ACTIVE;
    }
    
    $active = Yii::app()->isUserActive;
    
    $menu = array(
        array('label'=>Yii::t('fullnames', 'Users'), 
            'url'=>array('index'), 
            'icon'=>'book', 
            'visible'=>$isExtendRole,
        ),
        array('label'=>Yii::t('controls', 'Edit'),  
            'url'=>array('update', 'id'=>$model->UserID), 
            //'url'=>Yii::app()->isUserActive ? array('update', 'id'=>$model->UserID) : '#', 
            'icon'=>'pencil',
            //'disabled'=>!$active,
            'linkOptions'  => array(
                'title'=>Yii::t('fullnames', 'Edit personal information'), 
                //'data-toggle'=>"popover",
                //'data-toggle'=>!Yii::app()->isUserActive ? "modal" : "",
                //'data-placement'=>"left" ,
                //'data-content'=>"And here's some amazing content. It's very engaging. right?"
                //'class'=>"close",
                //'data-dismiss'=>"alert",
                //'onclick'=>'$("#mes_edit").popover({content: "какой то текст"; placement: left;});return false;',
                //'onclick'=>'$("#mes_edit").toggleClass("show"); $("#mes_edit").toggleClass("hide");return false;',
                //'onclick'=>'$("#mes_edit").toggleClass("show"); $("#mes_edit").toggleClass("hide");return false;',
            ),
            ),

        array('label'=>Yii::t('fullnames', 'Password'), 
            'url'=>'#', 
            'icon'=>'lock', 
            'visible'=>(!$isMyUserID && $isExtendRole),
            'linkOptions' => array(
                'title'=>Yii::t('controls','Generate').' '.Yii::t('fullnames', 'password'), 
                'confirm'=>Yii::t('controls', "Generate new password for user\n{name}?", array('{name}'=>$model->Email)),
                'submit'=>array('users/password', 'id'=>$model->UserID, 'auto'=>''),
            )),
        
        array('label'=>Yii::t('controls', 'Activate'), 
            'url'=>'#',
            'icon'=>'check',
            'linkOptions'  => array(
                'title'=>Yii::t('controls','Activate').Yii::t('fullnames', ' user'), 
                'confirm'=>Yii::t('controls', "Activate account for user\n{name}?", array('{name}'=>$model->UserName)),
                'submit'=>array('users/activate', 'id'=>$model->UserID),
            ),
            'visible'=>(!$isMyUserID && $isExtendRole && !$model->Active)
            ),
        
        array('label'=>Yii::t('controls', 'Deactivate'), 
            'url'=>'#',
            'icon'=>'check', 
            'linkOptions'  => array(
                'title'=>Yii::t('controls', 'Dectivate').Yii::t('fullnames', ' user'), 
                'confirm'=>Yii::t('controls', "Deactivate account for user\n{name}?", array('{name}'=>$model->UserName)),
                'submit'=>array('users/deactivate', 'id'=>$model->UserID),
            ),
            'visible'=>(!$isMyUserID && $isExtendRole && $model->Active)
            ),

        array('label'=>Yii::t('controls', 'Delete'), 
            'url'=>'#', 
            'icon'=>'trash',
            'linkOptions'=>array(
                'submit'=>array('users/delete','id'=>$model->UserID),
                'confirm'=>Yii::t('controls', "Are you sure you want to delete {item}\n{name}?", array('{item}'=>Yii::t('fullnames', ' user'), '{name}'=>$model->Email))
            ),
            'visible'=>(!$isMyUserID && $isExtendRole)),
        
        array('label'=>Yii::t('controls', Yii::t('controls', 'Change Password')), 
            'url'=>array('users/password', 'id'=>$model->UserID), 
            'icon'=>'lock', 
            'linkOptions'=>array(
                'title'=>Yii::t('fullnames', 'Changing your password'), 
            ),
            'visible'=>$isMyUserID),
            
        array('label'=>Yii::t('fullnames', 'Make Proposal'), 
            'url'=>array('proposal/create'),
            'icon'=>'flag',   
            'linkOptions'=>array(
                'title'=>Yii::t('fullnames', 'Make Proposal').' '.Yii::t('fullnames', 'on Competition'), 
            ),
            'visible'=>($isExtendRole && !$isMyUserID /*&& !$isProposalExists*/) || (!$isExtendRole && $isMyUserID /*&& !$isProposalExists*/)
        ),
        
        //комментируем, т.к. несколько команд    
        /*array('label'=>Yii::t('controls', Yii::t('controls', 'View').Yii::t('fullnames', ' of proposal')), 
            'url'=>array('proposal/view', 'id'=>($isProposalExists ? $proposal->propid : null)),
            'icon'=>'flag', 
            'linkOptions'=>array(
                'title'=>Yii::t('fullnames', 'View Proposal on Competition'), 
                ),
            'visible'=>($isMyUserID && $isProposalExists)
            ),

        
        array('label'=>Yii::t('controls', Yii::t('fullnames', 'My Command')), 
            'url'=>array('/command/view', 'id'=>Yii::app()->user->getCommandID()),
            'icon'=>'list', 
            'linkOptions'=>array(
                'title'=>'Ввод данных своей команды (тренеры, спортсмены)', //Yii::t('fullnames', Yii::t('fullnames', 'Entering list of sportsmen')), 
                ),
            'visible'=>($isMyUserID && $isProposalExists && $isProposalActive),
        ),*/
            
        array('label'=>'Управление', 'url'=>array('/competition/view'), 'icon'=>'wrench', 'visible'=>Yii::app()->user->isManagerRole()),
        array('label'=>'Админ', 'url'=>array('/competition/admin'), 'icon'=>'book', 'visible'=>Yii::app()->user->isAdminRole()),
        
        //array('label'=>Yii::t('fullnames', 'Enter Proposal'), 'url'=>array('/command/view', 'id'=>Yii::app()->user->getCommandID()), 'icon'=>'list', 'visible'=>(!$isGuest && !$isExtendRole)),            
    );
    
  //если юзер неактивен - сделать все пункты меню дисэйблеными, а по клику выводить модальное окно с сообщением
    if ($active <> Proposal::STATUS_ACTIVE)
        foreach($menu as $key=>$menuitem) {
            $menuitem['disabled'] = true;
            $menuitem['url'] = '#myModal';
            $menuitem['linkOptions']['data-toggle'] = 'modal'; 
            $menuitem['linkOptions']['role'] = "button";
            $menu[$key] = $menuitem;
        }
        
    $this->menu = $menu;
}  
?>

    <!--<div class="alert alert-error hide" id="mes_edit">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Внимание!</strong> Изменение данных будет разрешено после активации Вашей учётной записи.
    </div>
    
    <a class="btn btn-large btn-danger" data-content="And here's some amazing content. It's very engaging. right?" title="" data-toggle="popover" href="#" data-original-title="A Title">Click to toggle popover</a>

<div class="popover left">
<div class="arrow"></div>
<h3 class="popover-title">Popover left</h3>
<div class="popover-content">
<p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
</div>
</div>  


<a class="btn" title="" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="left" data-toggle="#popover" href="#" data-original-title="Popover on left">Popover on left</a>
<div id="popover" class="popover fade left in" style="top: 5.5px; left: 329px; display: block;">
<div class="arrow"></div>
<h3 class="popover-title">Popover on left</h3>
<div class="popover-content">Vivamus sagittis lacus vel augue laoreet rutrum faucibus.</div>
</div>-->

    <!-- Button to trigger modal 
    <a href="#myModal" role="button" class="btn" data-toggle="modal">Запустить демонстрацию модального элемента</a>  -->
     
    <!-- Modal -->
    <div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
            <h3 id="myModalLabel">Редактирование запрещено</h3>
        </div>
        <div class="modal-body">
            <p>Изменение данных будет разрешено после активации Вашей учётной записи</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Закрыть</button>
            <!--<button class="btn btn-primary">Сохранить изменения</button>-->
        </div>
    </div>