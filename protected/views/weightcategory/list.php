<?php
//DebugBreak();

$cssFile = Yii::app()->baseUrl . '/css/tosser.css';
Yii::app()->clientScript->registerCssFile($cssFile);
?>

<div>
<?php 
$this->breadcrumbs = array('Список участников по категорям'); 
$this->popTopHelp = array('data'=>'Для просмотра списка спортсменов весовой категории выберите нужную вкладку с возрастной категорией (горизонтальный список <strong>вверху</strong>), а затем нужную весовую категорию (вертикальный список <strong>слева</strong>): справа отобразится список спортсменов выбранной весовой категории');

//Yii::app()->user->setFlash('info', 'Для просмотра списка спортсменов весовой категории выберите нужную вкладку с возрастной категорией (горизонтальный список <strong>вверху</strong>), а затем нужную весовую категорию (вертикальный список <strong>слева</strong>): справа отобразится список спортсменов выбранной весовой категории');
//Yii::app()->user->setFlash('success', 'Скачать все протоколы жеребьевки в архиве ZIP будет возможно позже');
$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, /*'closeText'=>'&times;'*/), // success, info, warning, error or danger
            'info'=>array('block'=>true, 'fade'=>true, /*'closeText'=>'&times;'*/), // success, info, warning, error or danger
        ),
    ));

$docpath = Yii::app()->baseUrl.'/document/prot/';
?>

<!--<h1 id="tosser-head">Жеребьевка</h1>-->

<!--<a id="all-download" href="<?php echo $docpath.'all.zip'?>" style="color: maroon; font-weight: bold;">Списки по весовым</a>
<br><br>-->

<!--<p style="color: maroon; font-weight: bold;">Скачать все протоколы жеребьевки в архиве ZIP будет возможно позже</p>-->


<!--<p>Для просмотра списка спортсменов весовой категории выберите нужную вкладку с возрастной категорией (горизонтальный список вверху), 
а затем нужную весовую категорию (вертикальный список слева): справа отобразится список спортсменов выбранной весовой категории</p>-->

<!--<p style="color: maroon; font-weight: bold;">Скачать все протоколы жеребьевки в архиве ZIP будет возможно позже</p>-->

<div id="age-categories">

<?php  
 if (!empty($arrcategory)) {
  //цикл по возрастным категориям - сформировать табы по возрастам
    foreach ($arrcategory as $aid=>$age) {
        $weigths = array();
      //цикл по весовым категориям
        foreach ($age['children'] as $wid=>$weight) {
            //$weigthcontent = $weight['sportsmens'];
            //создать источник данных (для виджета грида, который во вьюшке _weigthlist)
            $dataProvider = new CArrayDataProvider($weight['sportsmens'], array(
                'totalItemCount'=>count($weight['sportsmens']),
                'keyField'=>false,
                'pagination'=>array(
                    'pageSize'=>50,
                ),
            ));    
            //прорендерить вьюшку _weigthlist одной весовой категории
            $weigthcontent = $this->renderPartial('/sportsmen/_weigthlist', array(
                'commandid'=>null,
                'dataProvider'=>$dataProvider,
                'isCache'=>false,
                'weigthid'=>$weight['id'],
            ), true, false);
            
            $weigths[] = array('label'=>$weight['text'] . ($weight['count'] ? ' (' . $weight['count'] . ')' : ''), 'content'=>$weigthcontent, 'active'=>!$wid);
        }
        //сформировать табы по весам
        $agecontent = $this->widget('bootstrap.widgets.TbTabs', array(
            'type'=>'tabs',//'pills',
            'placement'=>'left', // 'above', 'right', 'below' or 'left'
            'tabs'=>$weigths,
        ), true);
        $ages[] = array('label'=>$age['text'], 'content'=>$agecontent, 'active'=>!$aid);
    }
   
  //вывести Табы с возрастами  
    $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>$ages,
        'htmlOptions'=>array('style'=>'font-size: 12px'),
    ));
    
} else {  
?>
<p style="color: maroon; font-weight: bold;">Внимание! Списки спортсменов по категориям временно не отображаются. Просим прощения за временные неудобства...</p>
<?php } ?>

</div>
