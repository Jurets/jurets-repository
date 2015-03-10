<?php
$this->menu=array(
    array('label'=>Yii::t('controls', 'Operations')),
    array('label'=>Yii::t('fullnames', 'Competition'), 'url'=>array('/competition/view'), 'icon'=>'cog'),
    //array('label'=>'Заявки', 'url'=>array('/proposal/index')),
    array('label'=>Yii::t('fullnames', 'Commands'), 'url'=>array($this->pathCompetition . '/command/index'), 'icon'=>'flag'),
    array('label'=>Yii::t('fullnames', 'Sportsmens'), 'url'=>array('/sportsmen/index'), 'icon'=>'user'),
    array('label'=>Yii::t('fullnames', 'Coaches'), 'url'=>array('/coach/index'), 'icon'=>'user'),
    
    '---',
    array('label'=>Yii::t('fullnames', 'Make Proposal'), 
            'url'=>array('proposal/create'),
            'icon'=>'flag',   
            'linkOptions'=>array(
                'title'=>Yii::t('fullnames', 'Make Proposal').' '.Yii::t('fullnames', 'on Competition'), 
            ),
            //'visible'=>($isExtendRole && !$isMyUserID) || (!$isExtendRole && $isMyUserID)
            'visible'=>(Yii::app()->user->role == 'delegate')
        ),    
    array('label'=>Yii::t('fullnames', 'Judge Proposal'), 
            'url'=>array('judgeproposal/create'),
            'icon'=>'flag',   
            'linkOptions'=>array(
                'title'=>Yii::t('fullnames', 'Judge Proposal').' '.Yii::t('fullnames', 'on Competition'), 
            ),
            //'visible'=>($isExtendRole && !$isMyUserID) || (!$isExtendRole && $isMyUserID)
            'visible'=>(Yii::app()->user->role == 'judge')
        ),    
          
);
?>