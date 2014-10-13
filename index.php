<?php
//get params for application - from file "params.php" and "params-local.php" (if you need it, check - if it exists)
$root = dirname(__FILE__);
$params = file_exists($root) ? require($root . DIRECTORY_SEPARATOR . 'params.php') : array();

$ifdebug = isset($params['YII.debug'])? $params['YII.debug'] : true;
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', $ifdebug);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//include YII library
$yii = $params['YII.path']; //path for YII ()
require_once($yii);

//set local settings for application
$params = file_exists($root) ? require($root . DIRECTORY_SEPARATOR . 'params.php') : array();
//build config for application, including local settings
$config_path = dirname(__FILE__).'/protected/config/main.php';//path for application configure file
$config = require($config_path);

$basedirectory = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'protected';
require_once($basedirectory . str_replace('/', DIRECTORY_SEPARATOR, '/components/WebApplication.php'));

//create application instance
$app = Yii::createApplication('WebApplication', $config);

//run  application
$app->run();
?>