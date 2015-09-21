<?php
/**
*  Эта вьюшке используется пока что временно! Для нормальной версии предполагается исп-ть "_item"
* 
*/

$isVisible = !Yii::app()->user->isGuest && !Yii::app()->user->isExtendRole() && $data->isfiling;
//DebugBreak();
$parsed = parse_url(Yii::app()->request->getHostInfo());
//$baseUrl = $parsed['host'];
//$serverName = Yii::app()->request->serverName;
//$url = $data->path . '.' . $serverName;
$url = $parsed['scheme'] . '://' . (!empty($data->subdomain) ? $data->subdomain . '.' : '') . $parsed['host'];
//$url = http_build_url('', array("scheme" => $parsed['scheme'], "host" => $parsed['host']));
//$url = Yii::app()->createAbsoluteUrl($data->path . '.' . $parsed['host'], array() , $parsed['scheme']);

$logo_file = Yii::app()->basePath . '/../images/logo/' . $data->path . '.jpg';
if (is_file($logo_file)) {
    $logo = Yii::app()->baseUrl . '/images/logo/' . $data->path . '.jpg';
} else {
    $logo = Yii::app()->baseUrl . '/images/tkd_pic60x60.png';
}
    
?>

<style type="text/css">
    .media {
        background-color: #eee;
        border-radius: 6px;
        padding: 10px;
    }
</style>

<li class="media" style="border-bottom: 1px gray;">
    <!--<a class="pull-left" href="<?=Yii::app()->createAbsoluteUrl('competition/invite', array('id'=>$data->id))?>">-->
    <a class="pull-left" href="<?=$url?>" target="_blank">
        <!--<img class="media-object" src="<?=Yii::app()->baseUrl?>/images/tkd_57x60.png" alt="competition">-->
        <img class="media-object" src="<?=$logo?>" alt="competition">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?=$data->title?></h4>
        <p><?=DateHelper::dateToRus($data->begindate)?> - <?=DateHelper::dateToRus($data->enddate)?><p>
        <p><?=$data->place?></p>
        <!--<a class="button btn" href="<?=Yii::app()->createAbsoluteUrl($data->path . '/proposal/create', array())?>">Подать заявку</a>-->
        <?php 
        switch ($data->isfiling) {
            case Competition::FLG_ACTIVE : $label = 'заявки принимаются'; $type = 'success'; break;
            case Competition::FLG_NONACTIVE : $label = 'ожидается открытие'; $type = 'warning'; break;
            case Competition::FLG_ARCH : $label = 'архив'; $type = 'important'; break;
        }
        $this->widget('bootstrap.widgets.TbLabel', array(
            'type'=>$type, // 'success', 'warning', 'important', 'info' or 'inverse'
            'label'=>$label,
            //'label'=>($data->isfiling ? 'заявки принимаются' : 'приём заявок окончен'),
        )); 
        
        if ($isVisible) { 
            echo CHtml::tag('a', array('class'=>"button btn", 'href'=>Yii::app()->createAbsoluteUrl($data->path . '/proposal/create')), 'Подать заявку');
        } ?>
    </div>
</li>