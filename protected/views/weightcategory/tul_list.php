<?php
$cssFile = Yii::app()->baseUrl . '/css/tosser.css';
Yii::app()->clientScript->registerCssFile($cssFile);
?>

<div>
<?php 
$this->breadcrumbs = array('Список участников по категорям'); 
$this->popTopHelp = array('data'=>'Для просмотра списка спортсменов весовой категории выберите нужную вкладку с возрастной категорией (горизонтальный список <strong>вверху</strong>), а затем нужную весовую категорию (вертикальный список <strong>слева</strong>): справа отобразится список спортсменов выбранной весовой категории');

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

<div id="age-categories">

<?php  
 if (!empty($arrcategory)) {
    $index_a = 0;
  //цикл по возрастным категориям - сформировать табы по возрастам
    foreach ($arrcategory as $aid=>$age) {
        $divisions = array();
        $index_d = 0;
      //цикл по весовым категориям
        foreach ($age['divisions'] as $did=>$division) {
            //создать источник данных (для виджета грида, который во вьюшке _weigthlist)
            if ($division['count']) {
                $dataProvider = new CArrayDataProvider($division['sportsmens'], array(
                    'totalItemCount'=>count($division['sportsmens']),
                    'keyField'=>false,
                    'pagination'=>array(
                        'pageSize'=>50,
                    ),
                ));    
                //прорендерить вьюшку _weigthlist одной весовой категории
                $content = $this->renderPartial('/sportsmen/_tullist', array(
                    'dataProvider'=>$dataProvider,
                ), true, false);
            } else {
                $content = 'нет участников';
            }
            // --- добавить таб дивизиона
            $count = $division['count'] ? $this->widget('bootstrap.widgets.TbBadge', array(
                'label'=>$division['count'], 'type'=>'success', 'encodeLabel'=>false, 'htmlOptions' => array('style'=>'margin-left: 5px'), 
            ), true) : '';
            $divisions[] = array(
                'label'=>$division['name'] . ' (' . $division['text'] . ')' . $count, 
                'content'=>$content, 
                'active'=>!$index_d
            );
            $index_d++;
        }
        //сформировать табы по весам
        $agecontent = $this->widget('bootstrap.widgets.TbTabs', array(
            'type'=>'tabs',//'pills',
            'placement'=>'above', // 'above', 'right', 'below' or 'left'
            'encodeLabel'=>false, 
            'tabs'=>$divisions,
        ), true);
        // --- добавить таб возраста
        $count = $age['count'] ? $this->widget('bootstrap.widgets.TbBadge', array(
            'type'=>'default', 'encodeLabel'=>false, 'label'=>$age['count'], 'htmlOptions' => array('style'=>'margin-left: 5px'), 
            ), true) : '';
        $ages[] = array(
            'label'=>$age['text'] . $count, 
            'content'=>$agecontent, 
            'active'=>!$index_a,
        );
        $index_a++;
    }
   
  //вывести Табы с возрастами  
    $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'left', // 'above', 'right', 'below' or 'left'
        'tabs'=>$ages,
        'encodeLabel'=>false, 
        'htmlOptions'=>array('style'=>'font-size: 12px'),
    ));
    
} else {  
?>
<p style="color: maroon; font-weight: bold;">Внимание! Списки спортсменов по категориям временно не отображаются. Просим прощения за временные неудобства...</p>
<?php } ?>

</div>
