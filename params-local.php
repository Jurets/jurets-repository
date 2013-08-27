<?php
//здесь хранятся настройки локальные
return array(
    //'YII.path' => 'f:\Jurets\Projects\granat\trunk\common\lib\vendor\yiisoft\yii\framework\yii.php',
    'YII.path' => '.\YII\framework\yii.php',
    
    'env.code' => 'private',
    // DB connection configurations
    'db.name' => 'ftudb',
    'db.connectionString' => 'mysql:host=localhost;dbname=ftudb',
    'db.username' => 'root',
    'db.password' => '',
    'db.emulatePrepare' => true,
    'db.charset' => 'utf8',

    //настройки каталога для загрузки картинок
    'uploadDir'=>'f:/Jurets/Projects/tkdcard/uploads/',
    'uploadLoc' =>'http://tkd-card.my/uploads/',
    'defaultPhoto' =>'http://tkd-card.my/images/nophoto.png',
    
);
?>
