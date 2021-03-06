<?php

// check additional params
$addparams = include('addparams.php');
$mailparams = isset($addparams['mailparams']) ? $addparams['mailparams'] : $params['mailparams'];

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

//set alias for bootstrap component
Yii::setPathOfAlias('bootstrap', $params['bootstrap.path']);

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Система регистрации TKD-card',

    //Jurets
    //'execdate'=>'13 декабря 2012 года',
    
	// preloading components
    'preload' => array('log', 'bootstrap'),

    //set theme for application
    //'theme'=>'bootstrap', // requires you to copy the theme under your themes directory
    
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.widgets.*',
        'application.bootstrap.*',
        'ext.xupload.models.XUploadForm',
        //'application.extensions.yiidebugtb.*', //YII Debugger
        //'ext.yii-debug-toolbar.*',
        'application.extensions.yii-debug-toolbar.*',
        //расширение для работы с почтой
        'application.extensions.yii-mail.YiiMailMessage',
	),

    'aliases' => array(
        //If you manually installed it
        'xupload' => 'ext.xupload',
    ),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/* */
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'jurets',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            //for bootstrap
            'generatorPaths'=>array(
                'bootstrap.gii',
		    ),
        ),
        //Модуль для работы с изображениями (загрузка)
        'posting' => array (
            'class' =>'application.modules.posting.PostingModule',
        ),
        //Модуль для отсылки электронной почты
        //'cardmailer' => array (
        //    'class' =>'application.modules.cardmailer.MailerModule',
        //),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'WebUser',
            'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                // специальные правила
                'archive'=>'competition/archive',
                'archiveold'=>'competition/archiveold',
                'posts'=>'posting/default/index',
                'postupload'=>'posting/default/uploadportrait',
                'posting/<controller:\w+>/<action:\w+>'=>'posting/<controller>/<action>',
				'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
                // сокращающие правила
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',  
                // стандартные (дефолтные)
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<controller:\w+>'=>'<controller>/index',
                //'<path:[a-z0-9\(\)\"\'_\+-]+>'=>'competition/invite/<path>',
                '<path:\w+>'=>'competition/invite/path/<path>',
                '<path:\w+>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>/path/<path>',
                '<path:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>/id/<id>/path/<path>',
                '<path:\w+>/<controller:\w+>/<action:\w+>/id/<id:\d+>'=>'<controller>/<action>/id/<id>/path/<path>',
                //'<path:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                //'<path:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>/id/<id>',
			),
		),
		
		// MySQL database
		'db'=>array(
			'connectionString' => $params['db.connectionString'], //'mysql:host=localhost;dbname=ftudb',
			'emulatePrepare' => true,
			'username' => $params['db.username'], //'root',
			'password' => $params['db.password'], //'',
			'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'schemaCachingDuration' => 3600,
		),

        'cache'=>array(
            'class'=>'system.caching.CFileCache',
            /*'servers'=>array(
                array('host'=>'server1', 'port'=>11211, 'weight'=>60),
                array('host'=>'server2', 'port'=>11211, 'weight'=>40),
            ),*/
        ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace, info',
                    //'levels'=>'error, warning, trace, info',
                    //'categories'=>'system.*',
                    //'categories'=>'application',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
                    'levels'=>'info',
				),
				*/
                array(
                   'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                   //'ipFilters'=>array('127.0.0.1'),
                ),
                /*array( // configuration for the toolbar
                    'class'=>'XWebDebugRouter',
                    'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
                    'levels'=>'error, warning, trace, profile, info',
                    'allowedIPs'=>array('127.0.0.1', '::1' , '192.168.1.54', '192\.168\.1[0-5]\.[0-9]{3}'),
                ),*/
			),
		),
        'authManager'=>array(
            'class'=>'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),        
        
        //for bootstrap components
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
            //'responsiveCss' => true,
        ),
        
        /*'mailer'=>array(
            'class'=>'ext.mail.Mailer',
            'backend'=>'smtp',
            'backendParams'=>array(
                'host'=>$params['emailsender']['host'],
                'port'=>$params['emailsender']['port'],
                'auth'=>$params['emailsender']['auth'],
                'username'=>$params['emailsender']['username'],
                'password'=>$params['emailsender']['password'],
                'timeout'=>$params['emailsender']['timeout']
            ),
            'mimeParams'=>array(
                //...
            ),
        ),*/
        
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => $mailparams['mail.transportType'],
            'transportOptions' => $mailparams['mail.transportOptions'],
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false,
        ),
        
        'format' => array(
            //'class' => 'common.components.EDateFormatter',
            //'locale' => 'en_US',
            'dateFormat' => 'd.m.Y',
            'datetimeFormat' => 'd.m.Y h:i:s',
        ),

        /*'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array(
                'directory'=>'./uploads/',
            ),
        ),*/        
    ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
    'params' => CMap::mergeArray(   //params: merge arrays from param-file and from this file
        array(
		    //'adminEmail'=>'webmaster@example.com', // this is used in contact page
            'postsPerPage' => 30,                  //
	    ),
        $params   //params from param-file
    ),
    
    'sourceLanguage'=>'en_us',
    'language'=>isset($params['language']) ? $params['language'] : 'ru',
);

?>
