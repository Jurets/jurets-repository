<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo "Фотогалерея" /*Yii::app()->getController()->getTitle()*/?></title>
<meta name="Description" content="<?php echo "Фотогалерея" /*Yii::app()->getController()->getDescription()*/?>" />
<meta name="KeyWords" content="<?php echo "Фотогалерея" /*Yii::app()->getController()->getKeywords()*/?>" />
<meta name="viewport" content="width=device-width" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />
<meta name="robots" content="INDEX,FOLLOW" />
<link rel="shortcut icon" href="" />


<link href="<? echo Yii::app()->getBaseUrl(true).'/css/style.css';?>" rel="stylesheet" type="text/css" media="screen" />
<link href="<? echo Yii::app()->getBaseUrl(true).'/css/params.css';?>" rel="stylesheet" type="text/css" media="screen" />
<link href="<? echo Yii::app()->getBaseUrl(true).'/css/print.css';?>" rel="stylesheet" type="text/css" media="print" />
<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<script type="text/javascript" src="<? echo Yii::app()->getBaseUrl(true).'/javascript/common.js';?>"></script>
<script type="text/javascript" src="<? echo Yii::app()->getBaseUrl(true).'/javascript/jquery.youtube.js';?>"></script>

<link href="<? echo Yii::app()->getBaseUrl(true).'/css/style-popup.css';?>" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<? echo Yii::app()->getBaseUrl(true).'/javascript/common-popup.js';?>"></script>

</head>

<body>

<div id="window">
	<?=$content?>
</div>
</body>
</html>