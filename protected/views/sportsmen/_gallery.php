<?php
//объект соревнования
$competition = Competition::getModel();

//настроечные вычисления
$isMyCommand = Yii::app()->user->isMyCommand($commandid);
$isAccess = Yii::app()->user->isExtendRole() || $isMyCommand;

$this->widget('bootstrap.widgets.TbThumbnails', array(
    'id'=>'gallery-list',
    'dataProvider'=>$dataProvider,
    'itemView'=>'application.views.sportsmen._spfoto',   // refers to the partial view named '_post'
));
    
?>