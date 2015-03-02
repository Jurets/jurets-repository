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
//$isCompetition = ($competition->type == Competition::TYPE_COMPETITION);
$isCamp = $competition->isCamp;

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
    
$userName = $isGuest ? '' : '<span class="label label-info pull-right" style="margin-top: 10px; margin-left: 30px;">'.Yii::app()->user->name.'</span>';
   
echo "<div class='main-nav'>";
echo "<a href='#' id='open-close'><i class='icon-align-justify icon-white'></i></a>";
$this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'<i class="icon-home  icon-white"></i>',//Yii::t('fullnames', 'Homepage'), //
    'fixed'=>false, //'top',
    'brandUrl'=>Yii::app()->createAbsoluteUrl('/'),
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'navigation'),
            'items'=>array(
                array('label'=>Yii::t('fullnames', 'Competition'), 
                    'url' => ($isExtendRole ? array($this->pathCompetition . '/competition/view') : array($this->pathCompetition . '/competition/view')),
                ),
                //array('label'=>'Информация', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>Yii::t('fullnames', 'Commands'), 'url'=>($isExtendRole ? array($this->pathCompetition . '/command/manage') : array($this->pathCompetition . '/command/index'))),
                //array('label'=>'', 'url'=>'#', 'items'=>array(
                array('label'=>Yii::t('fullnames', 'Categories'), 'url'=>array($this->pathCompetition . '/weightcategory/category')),
                //)),
                array('label'=>Yii::t('fullnames', 'Weighing'), 'url'=>array($this->pathCompetition . '/weightcategory/list'), /*'visible'=>!$isCamp*/),
                array('label'=>Yii::t('fullnames', 'Toss'), 'url'=>array($this->pathCompetition . '/weightcategory/tosser'), 'visible'=>!$isCamp),
                array('label'=>Yii::t('fullnames', 'Results'), 'url'=>array($this->pathCompetition . '/weightcategory/results'), 'visible'=>!$isCamp),
                //array('label'=>Yii::t('fullnames', 'Photo'), 'url'=>array('/posting/default/index')),
                array('label'=>Yii::t('fullnames', 'Archive'), 'url'=>array('/competition/archive')),
                //array('label'=>'Контакты', 'url'=>array('/site/contact')),
                //array('label'=>'Регистрация', 'url'=>array('/proposal/create'), 'visible'=>Yii::app()->user->isGuest),
            ),
        ),
     //'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Поиск"></form>',
     //'<span class="label label-info" style="margin-top: 10px; margin-left: 30px;">'.Yii::app()->user->name.'</span>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>Yii::t('fullnames', 'Regin'), 'url'=>array('/users/create'), 'visible'=>$isGuest),
                array('label'=>Yii::t('fullnames', 'Login'), 'url'=>array('/site/login'), 'visible'=>$isGuest),
                array('label'=>Yii::t('fullnames', 'My Cabinet'), 'url'=>array('/users/mycabinet'), 'visible'=>!$isGuest),
                array('label'=>'', 'url'=>'#', 'items'=>array(
                    array('label'=>Yii::t('fullnames', 'Regin'), 'url'=>array('/users/create'), 'visible'=>$isGuest),                
                    array('label'=>Yii::t('fullnames', 'Login'), 'url'=>array('/site/login'), 'visible'=>$isGuest),
                    array('label'=>Yii::t('fullnames', 'Users'), 'url'=>array('/users/index'), 'icon'=>'user', 'visible'=>$isExtendRole),
                    array('label'=>Yii::t('fullnames', 'Proposals'), 'url'=>array('proposal/index'), 'icon'=>'book', 'visible'=>$isExtendRole),
                    array('label'=>Yii::t('controls', 'Manage'), 
                        'url'=>array('/competition/view'), 
                        'icon'=>'wrench', 
                        'visible'=>Yii::app()->user->isManagerRole()
                    ),
                    array('label'=>Yii::t('controls', 'Manage'), 
                        //'url'=>array('/competition/admin'), //ToDo: Функционал АДМИНа пока не работает
                        'url'=>array('/competition/view'), 
                        'icon'=>'book', 
                        'visible'=>Yii::app()->user->isAdminRole()
                    ),
                    array('label'=>Yii::t('fullnames', 'My Command'), 
                        'url'=>array('/command/view', 'id'=>Yii::app()->user->getCommandID()), 
                        'icon'=>'list', 
                        'linkOptions'=>array(
                            //'title'=>Yii::t('fullnames', 'Entering list of sportsmen'), 
                            'title'=>'Ввод данных своей команды (тренеры, спортсмены)', 
                        ),
                        'visible'=>(!$isGuest && !$isExtendRole && $isProposalExists && $isProposalActive)
                    ),
                    array('label'=>Yii::t('fullnames', 'Make Proposal'), 
                        'url'=>array('proposal/create'),
                        'icon'=>'flag',   
                        'linkOptions'=>array(
                            'title'=>Yii::t('fullnames', 'Make Proposal').Yii::t('fullnames', 'on Competition'), 
                        ),
                        'visible'=>/*($isExtendRole && !$isMyUserID && !$isProposalExists) || */(!$isGuest && !$isExtendRole/*$isMyUserID */&& !$isProposalExists)
                        ),

            
        /*array('label'=>Yii::t('controls', Yii::t('fullnames', 'Enter Proposal')), 
            'url'=>array('/command/view', 'id'=>Yii::app()->user->getCommandID()),
            'icon'=>'list', 
            'linkOptions'=>array(
                'title'=>Yii::t('fullnames', Yii::t('fullnames', 'Entering list of sportsmen')), 
            ),
            'visible'=>(!$isExtendRole && $isProposalExists)
            ),*/
            
                    '---',
                    array('label'=>Yii::t('fullnames', 'Exit').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'icon'=>'arrow-right', 'visible'=>!$isGuest),
                ), 'visible'=>!$isGuest),
            ),
        ),   
     $userName,
    ),
)); 
echo"</div>";

?>

    <?php if(isset($this->breadcrumbs)) { 
        if(isset($this->popTopHelp) && !empty($this->popTopHelp)) {//DebugBreak(); ?>
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
            $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			    'homeLink'=>CHtml::link($competition->name, Yii::app()->createAbsoluteUrl('/')),
                'links'=>$this->breadcrumbs,
		    )); ?>
        </div>
        <span style="overflow: hidden;"></span>
	<?php } ?>

	<?php echo $content; ?>

	<div class="clear" style="overflow: hidden; clear: both;"></div>

	<!--<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div>-->
<!-- footer -->

</div><!-- page -->

</body>
</html>