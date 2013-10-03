<?php

//set params for application
$root = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';
$params = file_exists($root) ? require($root . DIRECTORY_SEPARATOR . 'params.php') : array();

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
        'db'=>array(
            'connectionString' => $params['db.connectionString'], //'mysql:host=localhost;dbname=ftudb',
            //'emulatePrepare' => true,
            'username' => $params['db.username'], //'root',
            'password' => $params['db.password'], //'',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            //'schemaCachingDuration' => 3600,
        ),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);