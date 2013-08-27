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


return array(
	'YII.path' => 'f:\Jurets\Projects\granat\trunk\common\lib\vendor\yiisoft\yii\framework',
	
	'env.code' => 'private',
	// DB connection configurations
	'db.name' => 'ftudb',
	'db.connectionString' => 'mysql:host=localhost;dbname=ftudb',
	'db.username' => 'root',
	'db.password' => '',
    'db.emulatePrepare' => true,
    'db.charset' => 'utf8',

    //настройки каталога для загрузки картинок
    'uploadDir'=>'/uploads/',
    'uploadLoc' =>'http://localhost/wtfweb/uploads/',
    'defaultPhoto' =>'http://localhost/wtfweb/images/nophoto.png',
    //настройки для размеров загружаемых картинок
    'sizeW'=>808,
    'sizeH'=>541,
    'thumb_sizeW'=>307,
    'thumb_sizeH'=>210,

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
           ),
       ),
    'adminEmail' => 'admin@competition.ftu.com.ua',
    'fromEmail' => 'noreply@competition.ftu.com.ua',
    
    'errorcodes' => array(
        410 => 'Регистрация участников запрещена',
        411 => 'Заявка на соревнование уже подана',
    )
    //  'php.exePath' => '/usr/bin/php' path to php 

);