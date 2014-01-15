<?php
//здесь хранятся настройки локальные
return array(
    //'YII.path' => 'f:\Jurets\Projects\tkdcard\YII\framework\yii.php',
    'YII-console.path' => 'f:\Jurets\Projects\tkdcard\YII\framework\yiic.php',
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
    //'uploadDir'=>'/uploads/',
    'uploadDir'=>'d:\xampp\htdocs\wtfweb\trunk\uploads\\',
    'uploadLoc' =>'http://localhost/wtfweb/trunk/uploads/',
    'defaultPhoto' =>'http://localhost/wtfweb/trunk/images/nophoto.png',
    
    //ИД текущего соревнования (временная мера, до режима "мульти-компетишн")
    'defaultCompetitionID' => 3, 
    
    //ограничение на максимальное кол-во участников в ЗАЯВКЕ
    'maxParticipants' => 50, 
);
?>
