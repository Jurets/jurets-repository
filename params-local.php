<?php
//здесь хранятся настройки локальные
return array(
    'YII.path' => 'C:\xampp\htdocs\yii_main\framework\yii.php',
    
    'env.code' => 'private',
    // DB connection configurations
    'db.name' => 'ftudb',
    'db.connectionString' => 'mysql:host=localhost;dbname=ftudb',
    'db.username' => 'root',
    'db.password' => '',
    'db.emulatePrepare' => true,
    'db.charset' => 'utf8',

    //настройки каталога для загрузки картинок
    'uploadDir'=>'f:/Jurets/Projects/wtfweb/uploads/',
    'uploadLoc' =>'http://localhost:8068/uploads/',
    'defaultPhoto' =>'http://localhost:8068/images/nophoto.png',
    
);
?>
