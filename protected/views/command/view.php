<?php
    /* @var $this CommandController */
    /* @var $model Command */

    $myCommandID = Yii::app()->user->commandid; //ИД Моей команды
    $isMyCommand = !Yii::app()->isGuestUser && ($model->CommandID == $myCommandID);
    $isAccess = Yii::app()->isExtendRole || $isMyCommand;

    $strTitle = ($isMyCommand ? Yii::t('fullnames', 'My Command') : Yii::t('fullnames', 'Command View'));

    //хлебные крошки
    $this->breadcrumbs = array(
        Yii::t('fullnames', 'Commands')=>array('index'),
        ($isMyCommand ? Yii::t('fullnames', 'My Command') : $model->CommandName),
    );

    //меню
    $this->menu = array(
        //array('label'=>'Создать команду', 'url'=>array('create'), 'visible'=>Yii::app()->user->isExtendRole()),
        array('label'=>Yii::t('controls', 'Change name'), 
            'url'=>array('update', 'id'=>$model->CommandID), 
            'icon'=>'pencil', 
            'visible'=>Yii::app()->isAdmin, //$isAccess
        ),

        array('label'=>Yii::t('controls', 'Delete'), 
            'url'=>'#', 
            'icon'=>'trash',
            'linkOptions'=>array(
                'title'=>Yii::t('controls', 'Delete').Yii::t('fullnames', ' command'),
                'submit'=>array('delete','id'=>$model->CommandID),
                'confirm'=>'Вы действительно хотите удалить команду?'
                ), 
            'visible'=>Yii::app()->isAdmin //isExtendRole
            ),
        //array('label'=>'Фильтр / Поиск', 'url'=>array('admin')),
        array('label'=>Yii::t('controls', 'Create Sportsmen'), 'url'=>array('sportsmen/create','id'=>$model->CommandID), 'icon'=>'user', 'visible'=>$isAccess),//'visible'=>!Yii::app()->user->isGuest),

        array('label'=>Yii::t('controls', 'Create Coach'), 'url'=>array('coach/create','id'=>$model->CommandID), 'icon'=>'user', 'visible'=>$isAccess),//'visible'=>!Yii::app()->user->isGuest),
        //array('label'=>'Список команд', 'url'=>array('index')),
    );

    
    //ЗАГОЛОВОК
    echo CHtml::tag('h3', array(), $model->CommandName, true);
    
    
    // --------- содержимое вкладки "Общие сведения" ----------
    $infoContent = CHtml::tag('h3', array(), $strTitle, true);
    $infoContent .= $this->widget('bootstrap.widgets.TbDetailView', array(
        'data'=>$model,
        'nullDisplay'=>'<span class="null">'.Yii::t('fullnames', 'no data').'</span>',
        'attributes'=>array(
            'CommandName',
            array(
                'label'=>Yii::t('fullnames', 'coachCount'),
                'value'=>$model->coach_count,
            ),
            array(
                'label'=>Yii::t('fullnames', 'sportsmenCount'),
                'value'=>$model->sportsmen_count,
            ),
            array(
                'label'=>Yii::t('fullnames', 'Заявлено участников'),
                'value'=>$model->relProposal->participantcount,
            ),
            array(
                'label'=>Yii::t('fullnames', 'Заявка подана'),
                'value'=>$model->relProposal->created,
            ),
            array(
                'label'=>Yii::t('fullnames', 'Delegate'),
                'value'=>$model->relProposal->relUsers->UserFIO,
            ),
            array(
                'label'=>Yii::t('fullnames', 'Federation'),
                'value'=>$model->relProposal->federation,
            ),
            array(
                'label'=>Yii::t('fullnames', 'Country'),
                'value'=>$model->relProposal->country,
            ),
            array(
                'label'=>Yii::t('fullnames', 'City'),
                'value'=>$model->relProposal->city,
            ),
            array(
                'label'=>Yii::t('fullnames', 'Club'),
                'value'=>$model->relProposal->club,
            ),
            array(
                'label'=>Yii::t('fullnames', 'Address'),
                'value'=>$model->relProposal->address,
            ),
            
            'CommandID',
            array(
                'label'=>Yii::t('fullnames', 'ИД заявки'),
                'value'=>$model->relProposal->propid,
            ),
        ),
    ), true); 

    // --------- содержимое вкладки "Спортсмены" ----------
    $sportsmenContent = $this->renderPartial('/sportsmen/_sportsmen', array(
        'commandid'=>$model->CommandID,
        'dataProvider'=>$dataSportsmenList
    ), true);

    // --------- содержимое вкладки "Тренеры" ----------
    $coachContent = $this->renderPartial('/coach/_coach', array(
        'commandid'=>$model->CommandID,
        'dataProvider'=>$dataCoachList,
    ), true);
    
    // --------- содержимое вкладки "представитель" ----------
    $delegateContent = CHtml::tag('h3', array(), 'Сведения о представителе', true);
    $delegateContent .= $this->renderPartial('application.views.site._userdata', array('user'=>$model->relProposal->relUsers, 'isAccess'=>$isAccess), true);
      
    //ТабВью: показать на страничках раздельно спортсменов и тренеров
    $this->widget('bootstrap.widgets.TbTabs', array(
        //'skin'=>'default',
        'id'=>'command',
        'type'=>'tabs', //'pills'
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array('label'=>Yii::t('fullnames', 'Sportsmens'), 'content'=>$sportsmenContent, 'active'=>($tabnum == 1)),
            array('label'=>Yii::t('fullnames', 'Coaches'), 'content'=>$coachContent, 'active'=>($tabnum == 2)),
            array('label'=>Yii::t('fullnames', 'Overview'), 'content'=>$infoContent, 'active'=>($tabnum == 3)),
            array('label'=>Yii::t('fullnames', 'Delegate'), 'content'=>$delegateContent, 'active'=>($tabnum == 4)),
        ),
    ));

?>