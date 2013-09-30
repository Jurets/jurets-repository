<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
<div class="container" id="page">

<?php
$isGuest = Yii::app()->isGuestUser;
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
    
$this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'Главная',
    'fixed'=>false, //'top',
    'brandUrl'=>$this->createUrl('/site/index'),
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>Yii::t('fullnames', 'Competition'), 
                    'url' => ($isExtendRole ? array('/competition/manage') : array('/competition/view')),
                ),
                //array('label'=>'Информация', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>Yii::t('fullnames', 'Commands')/*'Участники'*/, 'url'=>array('/command/index')),
                //array('label'=>'Взвешивание', 'url'=>array('/weightcategory/list')),
                //array('label'=>'Жеребьевка', 'url'=>array('/weightcategory/tosser')),
                //array('label'=>'Результаты', 'url'=>array('/weightcategory/results')),
                array('label'=>'Фото', 'url'=>array('/posting/default/index')),
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
                array('label'=>'Регистрация', 'url'=>array('/users/create'), 'visible'=>$isGuest),
                array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>$isGuest),
                array('label'=>'Мой Кабинет', 'url'=>array('/users/mycabinet'), 'visible'=>!$isGuest),
                array('label'=>'', 'url'=>'#', 'items'=>array(
                    array('label'=>'Регистрация', 'url'=>array('/users/create'), 'visible'=>$isGuest),                
                    array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>$isGuest),
                    array('label'=>Yii::t('fullnames', 'Users'), 'url'=>array('/users/index'), 'icon'=>'user', 'visible'=>$isExtendRole),
                    /*array('label'=>Yii::t('fullnames', 'Proposals'), 'url'=>array('proposal/index'), 'icon'=>'book', 'visible'=>$isExtendRole),
                    array('label'=>'Управление', 
                        'url'=>array('/competition/manage'), 
                        'icon'=>'wrench', 
                        'visible'=>Yii::app()->user->isManagerRole()
                    ),
                    array('label'=>'Управление', 
                        //'url'=>array('/competition/admin'), //ToDo: Функционал АДМИНа пока не работает
                        'url'=>array('/competition/manage'), 
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
                    ),*/
                   
                    /*array('label'=>Yii::t('fullnames', 'Make Proposal'), 
                        'url'=>array('proposal/create'),
                        'icon'=>'flag',   
                        'linkOptions'=>array(
                            'title'=>Yii::t('fullnames', 'Make Proposal').Yii::t('fullnames', 'on Competition'), 
                        ),
                        'visible'=>(!$isGuest && !$isExtendRole && !$isProposalExists)
                        ),*/

            
        /*array('label'=>Yii::t('controls', Yii::t('fullnames', 'Enter Proposal')), 
            'url'=>array('/command/view', 'id'=>Yii::app()->user->getCommandID()),
            'icon'=>'list', 
            'linkOptions'=>array(
                'title'=>Yii::t('fullnames', Yii::t('fullnames', 'Entering list of sportsmen')), 
            ),
            'visible'=>(!$isExtendRole && $isProposalExists)
            ),*/
            
                    '---',
                    array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'icon'=>'arrow-right', 'visible'=>!$isGuest),
                ), 'visible'=>!$isGuest),
            ),
        ),   
     $userName,
    ),
)); 

?>

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear" style="overflow: hidden; clear: both;"></div>

	<!--<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div>-->
<?php
/*$this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'Главная',
    'brandUrl'=>$this->createUrl('/site/index'),
    'fixed'=>false, //'bottom',
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>$isGuest),
                array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!$isGuest),
                array('label'=>'Регистрация', 'url'=>array('/users/create'), 'visible'=>$isGuest),
                array('label'=>'Мой Кабинет', 'url'=>array('/users/mycabinet')),
            ),
        ),
    ),
));*/ 
    
?>    
<!-- footer -->

</div><!-- page -->

</body>
</html>
