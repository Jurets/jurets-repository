<li class="media">
    <!--<a class="pull-left" href="<?=Yii::app()->createAbsoluteUrl('competition/invite', array('id'=>$data->id))?>">-->
    <a class="pull-left" href="<?=Yii::app()->createAbsoluteUrl($data->path)?>">
        <img class="media-object" src="<?=Yii::app()->baseUrl?>/images/tkd_57x60.png" alt="competition">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?=$data->title?></h4>
        <p><?=DateHelper::dateToRus($data->begindate)?> - <?=DateHelper::dateToRus($data->enddate)?><p>
        <p><?=$data->place?></p>
        <a href="<?=Yii::app()->createAbsoluteUrl($data->path . '/proposal/create', array(/*'path'=>$data->path 'id'=>$data->id*/))?>">Подать заявку</a>
    </div>
</li>

