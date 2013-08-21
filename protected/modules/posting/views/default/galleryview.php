<?php

foreach ($gallery as $data) {
    if (isset($photo->pfilesize)) 
        $filename = Yii::app()->getUploadImageUrl($data->filename);
    else
        $filename = $data->filename;
    
    if ($filename <> Yii::app()->params['defaultPhoto']) {

       if (isset($photo->pfilesize)) 
           $filename = Yii::app()->getUploadImageUrl($data->filename);
       else
           $filename = $data->filename;

       $items[] = array(
            'image'=>$filename,
            //'label'=>$data->orig_name,
            'caption'=>ContentHelper::linesWrap($data->description, ContentHelper::getAttrMaxLength($data, 'description')/3, 3)
       ); 
    }
}    

$this->widget('bootstrap.widgets.TbCarousel', array(
    'items'=>$items
));

?>

<!--<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
    <?php     
    /*foreach ($gallery as $data) {
        $filename = Yii::app()->getUploadImageUrl($data->filename);
        $caption = ContentHelper::linesWrap($data->description, ContentHelper::getAttrMaxLength($data, 'description')/3, 3);*/
    ?>
        <div class="active item">
            <img alt="" src="<?php //echo $filename ?>">
            <div class="carousel-caption">
                <h4><?php //echo $caption ?></h4>
                <p><?php //echo $data->filename ?></p>
            </div>
        </div>
    <?php //} ?>
    </div>
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>-->






