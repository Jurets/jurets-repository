<?php
    $url = isset($data->relPhoto) ? $data->relPhoto->filename : null;
?>

<li class="span2">
    <a href="<?= Yii::app()->createAbsoluteUrl('sportsmen/view/', array('id'=>$data->SpID)) ?>" class="thumbnail">
        <img src="<?= Yii::app()->getUploadImageUrl($url) ?>" alt="">
    </a>
    <span><?= $data->FullName ?></span>
</li>