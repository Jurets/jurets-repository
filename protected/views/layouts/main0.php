<?php /* @var $this Controller */ 

$imgpath = Yii::app()->baseUrl.'/images/logo/';
$docpath = Yii::app()->baseUrl.'/document/';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

    <!--Jurets-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/wtfsite.css" />
    <!--Jurets-->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header"> 
        <div id="logo">
            <!--<img src="images/turn_logo.png" alt="логотип">   -->
            <img width="88" height="116" title="логотип ФТУ" alt="логотип ФТУ" src="<?php echo $imgpath?>ftu.png">
            <div id="textHead"> Открытый портал проведения соревнований
                <?php 
                    //echo CHtml::encode(Yii::app()->name);
                    //echo CHtml::encode(Competition::getCompetitionParam('name'));
                ?>
            </div>
        
            <div id="loginmenu">
            <?php
            /*$this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                //array('label'=>'Мой Кабинет', 'url'=>array('/proposal/mycabinet')),
                array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
            ));*/
            ?>
            </div>
        </div>
        
		<div id="mainmenu">
        <?php /*$this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Главная', 'url'=>array('/site/index')),
                //array('label'=>'Заявки', 'url'=>array('/proposal/index')),
                array('label'=>'Информация', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Участники', 'url'=>array('/command/index')),
                array('label'=>'Жеребьевка', 'url'=>array('/weightcategory/tosser')),
                array('label'=>'Результаты', 'url'=>array('/weightcategory/results')),
                //array('label'=>'Контакты', 'url'=>array('/site/contact')),
                array('label'=>'Регистрация', 'url'=>array('/proposal/create'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Ввод заявок', 'url'=>array('/command/view&id='.Yii::app()->user->getCommandID()), 'visible'=>(!Yii::app()->user->isGuest && !Yii::app()->user->isExtendRole())),
                array('label'=>'Мой Кабинет', 'url'=>array('/proposal/mycabinet'), 'visible'=>(!Yii::app()->user->isGuest && !Yii::app()->user->isExtendRole())),
                array('label'=>'Управление', 'url'=>array('/competition/view'), 'visible'=>Yii::app()->user->isManagerRole()),
                array('label'=>'Админ', 'url'=>array('/competition/admin'), 'visible'=>Yii::app()->user->isAdminRole()),
            ),
        ));*/ ?>
    </div><!-- mainmenu -->
    </div><!-- header -->

    
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">
        Адреса для связи с организаторами сайта: 
        <a href="mailto:me@youremail.com">e-mail jurets75@rambler.ru</a> 
        <a href="mailto:me@youremail.com">e-mail vadosrbd@rambler.ru</a>
        <!--Copyright &copy; <?php echo date('Y'); ?> by Jurets.<br/> All Rights Reserved.<br/>-->
        <!-- <?php echo Yii::powered(); ?> -->
    </div><!-- footer -->

</div><!-- page -->

</body>
</html>
