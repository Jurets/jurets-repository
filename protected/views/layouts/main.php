<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/stylesinv.css" />-->
    <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />-->
    
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    	<?php Yii::app()->bootstrap->register(); ?>
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/engine.js" ></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />
</head>

<body>

<?php include_once("analyticstracking.php") ?>

<div class="container" id="page">

<?php 
//получить объект Соревнования
$competition = Competition::getModel();

$isITF = $competition->type == 'itf';

//определить права текущего юзера
$isGuest = Yii::app()->isGuestUser; //определить - является ли юзер гостем
if (!$isGuest) 
    $isExtendRole = Yii::app()->isExtendRole; 
else
    $isExtendRole = false;

if (!$isGuest && !$isExtendRole) {
    $proposal = Proposal::model()->proposalForCompetition(0, Yii::app()->userid);
}
$isProposalExists = isset($proposal);
if ($isProposalExists) {
    $isProposalActive = $proposal->status == Proposal::STATUS_ACTIVE;
}
    
$userName = $isGuest ? '' : '
    <a href="'.Yii::app()->createAbsoluteUrl('/users/mycabinet').'"> 
        <span class="label label-info pull-right" style="margin-top: 10px; margin-left: 30px; border-bottom: dotted;" title="'.Yii::t('fullnames', 'My Cabinet').'">
            '.Yii::app()->user->name.'
        </span>
    </a>';

$brandUrl = Yii::app()->createAbsoluteUrl('/');

// ГЛАВНОЕ МЕНЮ
echo "<div class='main-nav'>";
echo "<a href='#' id='open-close'><i class='icon-align-justify icon-white'></i></a>";
$this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'<i class="icon-home icon-white"></i>', //Yii::t('fullnames', 'Homepage'), //,
    'fixed'=>false, //'top',
    'brandUrl'=>$brandUrl,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'navigation'),
            'items'=>array(
                array(
                    'label'=>Yii::t('fullnames', 'Help'), 
                    'url' => array($this->pathCompetition . '/site/help'),
                    'visible'=>$competition->isMain,
                ),
                array(
                    'label'=>Yii::t('fullnames', 'Competition'), 
                    'url' => ($isExtendRole ? array($this->pathCompetition . '/competition/view') : array($this->pathCompetition . '/competition/view')),
                    'visible'=>!$competition->isMain,
                ),
                //команды турнира
                array(
                    'label'=>Yii::t('fullnames', 'Commands'), 
                    'url'=>($isExtendRole ? array($this->pathCompetition . '/command/manage') : array($this->pathCompetition . '/command/index')),
                    'visible'=>!$competition->isMain,
                ),
                // категории спарринга
                array(
                    'label'=> $isITF ? Yii::t('fullnames', 'Sparring') : Yii::t('fullnames', 'Categories'), 
                    'url'=>array($this->pathCompetition . '/weightcategory/category'),
                    'visible'=>!$competition->isMain,
                ),
                // категории пумсэ (тули)
                array(
                    'label'=> $isITF ? Yii::t('fullnames', 'Personal tul') : Yii::t('fullnames', 'Categories'), 
                    'url'=>array($this->pathCompetition . '/weightcategory/tul'),
                    'visible'=>!$competition->isMain,
                ),
                //)),
                array(
                    'label'=>Yii::t('fullnames', 'Weigthing'), 
                    'url'=>array($this->pathCompetition . '/weightcategory/list'), 
                    'visible'=>!$competition->isMain,
                ),
                array(
                    'label'=>Yii::t('fullnames', 'Toss'), 
                    'url'=>array($this->pathCompetition . '/weightcategory/tosser'), 
                    'visible'=>($competition->isCompetition || $isITF),
                ),
                array(
                    'label'=>Yii::t('fullnames', 'Results'), 
                    'url'=>array($this->pathCompetition . '/weightcategory/result'), 
                    'visible'=>($competition->isCompetition || $isITF),
                ),
                //array('label'=>Yii::t('fullnames', 'Photo'), 'url'=>array('/posting/default/index')),
                array(
                    'label'=>Yii::t('fullnames', 'Archive'), 
                    'url'=>array('/competition/archive')
                ),
                //array('label'=>'Контакты', 'url'=>array('/site/contact')),
                //array('label'=>'Регистрация', 'url'=>array('/proposal/create'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'', 'url'=>'#', 'items'=>
                    array(
                        array('label'=>Yii::t('fullnames', 'Regin'), 'url'=>array('/users/create'), 'visible'=>$isGuest),                
                        array(
                            'label'=>Yii::t('fullnames', 'Login'), 
                            'url'=>array('/site/login'), 
                            'visible'=>$isGuest && !$competition->isMain,
                        ),
                        array('label'=>Yii::t('fullnames', 'Users'), 'url'=>array('/users/index'), 'icon'=>'user', 'visible'=>$isExtendRole),
                        array('label'=>Yii::t('fullnames', 'Proposals'), 'url'=>array('proposal/index'), 'icon'=>'book', 'visible'=>$isExtendRole),
                        array('label'=>Yii::t('fullnames', 'Judge Proposals'), 'url'=>array('judgeproposal/index'), 'icon'=>'book', 'visible'=>$isExtendRole),
                        array('label'=>Yii::t('controls', 'Manage'), 
                            'url'=>array('/competition/view'), 
                            'icon'=>'wrench', 
                            'visible'=>Yii::app()->user->isManagerRole()
                        ),
                        array('label'=>Yii::t('controls', 'Manage'), 
                            'url'=>array('/competition/view'), 
                            'icon'=>'book', 
                            'visible'=>Yii::app()->user->isAdminRole()
                        ),
                        array('label'=>Yii::t('fullnames', 'My Command'), 
                            'url'=>array('/command/view', 'id'=>Yii::app()->user->getCommandID()), 
                            'icon'=>'list', 
                            'linkOptions'=>array(
                                'title'=>Yii::t('fullnames', 'Input your team (coaches, competitors)'),
                            ),
                            'visible'=>(!$isGuest && !$isExtendRole && $isProposalExists && $isProposalActive)
                        ),
                        array('label'=>Yii::t('fullnames', 'Make Proposal'), 
                            'url'=>array('proposal/create'),
                            'icon'=>'flag',   
                            'linkOptions'=>array(
                                'title'=>Yii::t('fullnames', 'Make Proposal').Yii::t('fullnames', 'on Competition'), 
                            ),
                            'visible'=>(!$isGuest && !$isExtendRole && !$isProposalExists)
                            ),
                        '---',
                        //array('label'=>Yii::t('fullnames', 'Exit').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'icon'=>'arrow-right', 'visible'=>!$isGuest),
                    ), 
                    'visible'=>!$isGuest,
                ),
            ),
        ),
     //'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Поиск"></form>',
     //'<span class="label label-info" style="margin-top: 10px; margin-left: 30px;">'.Yii::app()->user->name.'</span>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array(
                    'label'=>Yii::t('fullnames', 'Login'), 
                    'url'=>array('/site/login'), 
                    'visible'=>$isGuest && !$competition->isMain
                ),
                array(
                    'label'=>Yii::t('fullnames', 'Regin'), 
                    'url'=>array('/users/create'), 
                    'visible'=>$isGuest && !$competition->isMain
                ),
                array('label'=>'', 'url'=>'#', 'items'=>
                    array(
                        //array('label'=>Yii::t('fullnames', 'Regin'), 'url'=>array('/users/create'), 'visible'=>$isGuest),
                        array('label'=>Yii::t('fullnames', 'Regjudge'), 'url'=>array('/judge/create'), 'visible'=>$isGuest),
                    ), 
                    'visible'=>$isGuest && !$competition->isMain
                ),
                //array('label'=>Yii::t('fullnames', 'My Cabinet'), 'url'=>array('/users/mycabinet'), 'visible'=>!$isGuest),
                array(
                    'url'=>array('/site/logout'), 
                    'linkOptions'=>array(
                        'title'=>Yii::t('fullnames', 'Exit').' ('.Yii::app()->user->name.')', 
                    ),
                    'icon'=>'icon-share icon-white', 
                    'visible'=>!$isGuest
                ),
            ),
        ),   
     $userName,
    ),
)); 
echo"</div>";

?>

    <?php if(isset($this->breadcrumbs)) { 
        if(isset($this->popTopHelp) && !empty($this->popTopHelp)) { ?>
            <div style="float: right;">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label'=>'?',
                        'type'=>'info',
                        'htmlOptions'=>array(
                            'id'=>'btnTopHelp',
                            'data-title'=>isset($this->popTopHelp['title']) ? $this->popTopHelp['title'] : 'Подсказка', 
                            'data-content'=>isset($this->popTopHelp['data']) ? $this->popTopHelp['data'] : '', 
                            'rel'=>'popover', 
                            'data-placement'=>'left',
                        ),
                    )); ?>
            </div>
        <?php } ?>
		<div>
            <?php 
            $homeLink = CHtml::link(($competition->isMain ? '<i class="icon-home"></i>' : $competition->name), $brandUrl);
            $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			    'homeLink'=>$homeLink,
                'links'=>$this->breadcrumbs,
		    )); ?>
        </div>
        <span style="overflow: hidden;"></span>
	<?php } ?>

	<?php echo $content; ?>

	<div class="clear" style="overflow: hidden; clear: both;"></div>

    
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <ul id="yw0" class="navigation nav">
                <li>
                    <a class="" href="/site/help" title="Рекомендації по роботі з сайтом" target="_blank" >
                        <i class="icon-question-sign icon-white"></i>&nbsp;Допомога
                    </a>
                </li>
                <!--<li>
                    <a class="" href="http://youtu.be/XIaWEN4dvAk" title="Відео-допомога: Реєстрація на сайті" target="_blank" >
                        <i class="icon-facetime-video icon-white"></i>&nbsp;Реєстрація
                    </a>
                </li>-->            
                <!--<li class="divider-vertical"></li>-->
                <!--<li>
                    <a class="" href="http://youtu.be/kvAYbqXYNys" title="Відео-допомога: Додати нового учасника змагань" target="_blank" >
                        <i class="icon-facetime-video icon-white"></i>&nbsp;Додати учасника
                    </a>
                </li>-->            
            </ul>
            
            <ul id="yw0" class="navigation nav pull-right">
                <li>
                    <a class="" href="mailto:jurets75@gmail.com" title="email Админа" target="_blank" >
                        <i class="icon-envelope icon-white"></i>&nbsp;jurets75@gmail.com
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    
    <!--<div class="well well-small">
        <a class="btn btn-mini" href="">Помощь</a>
        <a class="" href="http://youtu.be/XIaWEN4dvAk" title="Відео-допомога: Реєстрація на сайті">
            <i class="icon-facetime-video icon-white"></i>
            Реєстрація
        </a>
    <div class="partnspon">
        <p>Відео-допомога</p>
        <a target="_blank" href="http://youtu.be/XIaWEN4dvAk" title="Відео-допомога: Реєстрація на сайті">
            <img width="110" height="160" title="Відео-допомога: Реєстрація на сайті" alt="Відео-допомога: Реєстрація на сайті" src="/images/logo/video1.png">
        </a>
    </div>
    
    <div class="partnspon">
        <a target="_blank" href="http://youtu.be/kvAYbqXYNys" title="Відео-допомога: Додати нового учасника змагань">
            <img width="138" height="103" title="Відео-допомога: Додати нового учасника змагань" alt="Відео-допомога: Додати нового учасника змагань" src="/images/logo/video2.png">
        </a>
    </div>
            
    </div>-->
    
	<!--<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div>-->
<!-- footer -->

</div><!-- page -->

</body>
</html>