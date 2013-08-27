<?php
/**
 * params-local.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 5:59 PM
 *
 *
 * ANY CONFIGURATION OPTIONS HERE WILL REPLACE THOSE INCLUDED ON THE params-env.php file!!!
 * It holds your local configuration settings.
 *
 * Replace following tokens for your local correspondent configuration data
 *
 * {DATABASE-NAME} ->   database name
 * {DATABASE-HOST} -> database server host name or ip address
 * {DATABASE-USERNAME} -> user name access
 * {DATABASE-PASSWORD} -> user password
 *
 * {DATABASE-TEST-NAME} ->   Test database name
 * {DATABASE-TEST-HOST} -> Test database server host name or ip address
 * {DATABASE-USERNAME} -> Test user name access
 * {DATABASE-PASSWORD} -> Test user password
 */

// получить локальные параметры 
// для настроек на конкретном хосте (или на домашнем компе)
$commonConfigDir = dirname(__FILE__);
$commonParamsLocalFile = $commonConfigDir . DIRECTORY_SEPARATOR . 'params-local.php';
$commonParamsLocal = file_exists($commonParamsLocalFile) ? require ($commonParamsLocalFile) : array();

//CMap::mergeArray(
return array_merge(array(
    'YII.path' => 'f:\Jurets\Projects\granat\trunk\common\lib\vendor\yiisoft\yii\framework',
    
    'env.code' => 'private',
    // DB connection configurations
    'db.name' => 'ftudb',
    'db.connectionString' => 'mysql:host=localhost;dbname=u9140_ftudb',
    'db.username' => 'u9140_root',
    'db.password' => 'jurets75',
    'db.emulatePrepare' => true,
    'db.charset' => 'utf8',

    //настройки каталога для загрузки картинок
    'uploadDir'=>'./uploads/',
    'uploadLoc' =>'http://tkd-card.com.ua/uploads/',
    'defaultPhoto' =>'http://tkd-card.com.ua/images/nophoto.png',
	
//настройки для размеров загружаемых картинок (по умолчанию)
    'sizeW'=>808,
    'sizeH'=>541,
    'thumb_sizeW'=>307,
    'thumb_sizeH'=>210,

    //настройки для размеров загружаемых картинок (фотогалерея)
    'sizeGallery' => array(
        'sizeW'=>808,
        'sizeH'=>541,
        'thumb_sizeW'=>307,
        'thumb_sizeH'=>210,
     ),
     
    //настройки для размеров загружаемых картинок (портреты)
    'sizePortrait' => array(
        'sizeW'=>190,
        'sizeH'=>265,
        'thumb_sizeW'=>95,
        'thumb_sizeH'=>132,
     ),
    
    //настройки почты (Email)
    'emailsender' => array(
        'method' => 'PEAR', //возможные значения: 'SMTP', 'PEAR'
        'from' => 'admin@tkd-card.com.ua',
        'host'=>'ssl://smtp.gmail.com',
        'port'=>'465',
        'auth'=>true,
        'username'=>'jurets75',
        'password'=>'steruj75',
        'timeout'=>500,
        'templates' => array(
           'invitation' => array(
                'subject' => 'Регистрация в системе', 
                'body' =>   "Здравствуйте!\r\n".
                            'Вы успешно зарегистрировались на сайте {hostname}'."\r\n".' с сылкой на этот E-mail.'."\r\n".
                            "Введённый Вами  при регистрации E-mail становится логином для авторизованного входа.\r\nТакже для Вас автоматически сгенерирован пароль.\r\n".
                            "Ваши Регистрационные данные:\r\n".
                            "================================================================================\r\n".
                            "Логин: {login}\r\n".
                            "Пароль: {password}\r\n".
                            "================================================================================\r\n".
                            "Проверьте ещё раз эти данные, и в случае необходимости свяжитесь с организаторами".
                            "Вы можете авторизоваться на сайте, используя логин и пароль, указанные выше.\r\n".
                            "После авторизации вы сможете сменить пароль в Кабинете.".
                            "Также Вы можете изменить Ваши персональные данные.".
                            "В течение трёх дней Ваша регистрация будет подтверждена и на указаный Вами E-mail будет выслано письмо с подтверждением."
                ),
           'autopassword' => array(
                'subject' => 'Новый пароль ', 
                'body' =>   "Здравствуйте!\r\n".
                            'Вас приветствует сайт {hostname}'."\r\n".
                            "Для Вас автоматически сгенерирован новый пароль.\r\n".
                            "Ваши Регистрационные данные:\r\n".
                            "================================================================================\r\n".
                            "Логин: {login}\r\n".
                            "Пароль: {password}\r\n".
                            "================================================================================\r\n".
                            "Проверьте ещё раз эти данные, и в случае необходимости свяжитесь с организаторами".
                            "Вы можете авторизоваться на сайте, используя логин и пароль, указанные выше.\r\n".
                            "После авторизации вы сможете сменить пароль в Кабинете."
                ),
           'changedata' => array(
                'subject' => 'Изменение персональных данных', 
                'body' =>   "Здравствуйте!\r\n".
                            'Вас приветствует сайт {hostname}'."\r\n".
                            "Ваши Регистрационные данные были изменены:\r\n".
                            "================================================================================\r\n".
                            "Фамилия: {lastname}\r\n".
                            "Имя: {firstname}\r\n".
                            "================================================================================\r\n".
                            "Проверьте ещё раз эти данные, и в случае необходимости свяжитесь с организаторами."
                ),
           'activation' => array(
                'subject' => 'Активация учётной записи', 
                'body' =>   "Здравствуйте!\r\n".
                            'Вас приветствует сайт {hostname}'."\r\n".
                            "Ваша учётная запись активирована! Теперь Вы можете:\r\n".
                            "================================================================================\r\n".
                            "- редактировать персональные данные\r\n".
                            "- подать заявку на соревнование*\r\n".
                            "================================================================================\r\n".
                            "В случае необходимости свяжитесь с организаторами."
                ),
           'deactivation' => array(
                'subject' => 'Дективация учётной записи', 
                'body' =>   "Здравствуйте!\r\n".
                            'Вас приветствует сайт {hostname}'."\r\n".
                            "Ваша учётная запись временно деактивирована! На данный момент Вы можете только:\r\n".
                            "================================================================================\r\n".
                            "- просматривать свои персональные данные\r\n".
                            "================================================================================\r\n".
                            "В случае необходимости свяжитесь с организаторами."
                ),
           'confirm' => array(
                'subject' => 'Подтверждение заявки', 
                'body' =>   "Здравствуйте!\r\n".
                            'Вас приветствует сайт {hostname}'."\r\n".
                            "Ваша заявка подтверждена! Теперь Вы можете:\r\n".
                            "================================================================================\r\n".
                            "- редактировать персональные данные\r\n".
                            "- вводить тренеров\r\n".
                            "- вводить спортсменов\r\n".
                            "================================================================================\r\n".
                            "В случае необходимости свяжитесь с организаторами."
                ),
           'cancel' => array(
                'subject' => 'Деактивация заявки', 
                'body' =>   "Здравствуйте!\r\n".
                            'Вас приветствует сайт {hostname}'."\r\n".
                            "Ваша заявка временно деактивирована! На данный момент Вы можете только:\r\n".
                            "================================================================================\r\n".
                            "- редактировать персональные данные\r\n".
                            "================================================================================\r\n".
                            "В случае необходимости свяжитесь с организаторами."
                ),
           ),
       ),
    'adminEmail' => 'admin@competition.ftu.com.ua',
    'fromEmail' => 'noreply@competition.ftu.com.ua',
    
    'errorcodes' => array(
        401 => 'Доступ запрещен',
        402 => 'Ограничение соревнования',
        409 => 'Редактирование информации запрещено',
        410 => 'Регистрация участников запрещена',
        411 => 'Заявка на соревнование уже подана',
    )
    //  'php.exePath' => '/usr/bin/php' path to php 
    ), 
//Локальный файл параметров
    $commonParamsLocal
);
