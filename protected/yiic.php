<?php //DebugBreak();
//get params for application - from file "params.php" and "params-local.php" (if you need it, check - if it exists)
$root = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..';
$params = file_exists($root) ? require($root . DIRECTORY_SEPARATOR . 'params.php') : array();

// change the following paths if necessary
$yiic=$params['YII-console.path']; //'C:\xampp\php\YII\framework\yiic.php';
$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
