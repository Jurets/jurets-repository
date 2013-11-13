<?php
//DebugBreak();

$cssFile = Yii::app()->baseUrl . '/css/tosser.css';
Yii::app()->clientScript->registerCssFile($cssFile);


$this->breadcrumbs=array(
    'Жеребьевка',
);

$docpath = Yii::app()->baseUrl.'/document/prot/';
?>

<h1 id="tosser-head">Жеребьевка</h1>

<!--<a id="all-download" href="<?php echo $docpath.'all.zip'?>" style="color: maroon; font-weight: bold;">Списки по весовым</a>
<br><br>-->

<!--<p style="color: maroon; font-weight: bold;">Скачать все протоколы жеребьевки в архиве ZIP будет возможно позже</p>-->


<p>Для просмотра списка спортсменов весовой категории выберите нужную вкладку с возрастной категорией (горизонтальный список вверху), 
а затем нужную весовую категорию (вертикальный список слева): справа отобразится список спортсменов выбранной весовой категории</p>
<p style="color: maroon; font-weight: bold;">Скачать все протоколы жеребьевки в архиве ZIP будет возможно позже</p>

<div id="age-categories">

<?php  
 if (!empty($arrcategory)) {
  //цикл по возрастным категориям - сформировать табы по возрастам
    foreach ($arrcategory as $aid=>$age) {
        $weigths = array();
      //цикл по весовым категориям
        foreach ($age['children'] as $wid=>$weight) {
            $weigthcontent = $weight['sportsmens'];
            $weigths[] = array('label'=>$weight['text'], 'content'=>$weigthcontent, 'active'=>!$wid);
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
    ));
    
    $weigth_arr = array();
    $columns = array();
   // DebugBreak();
  //вывести кол-во по категориям  
    foreach ($arrcategory as $aid=>$age) {
        $this->widget('bootstrap.widgets.TbLabel', array(
            'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
            'label'=>$age['text'],
        ));
        /*$weigth_item = array();
        $weigth_item[$age['text']] = 1;
        $weigth_arr[] = $weigth_item;
        
        $column = array();
        $column['name'] = $age['text'];
        $column['header'] = $age['text'];
        $columns[] = $column;*/
        
        $weigths = '';
        foreach ($age['children'] as $wid=>$weight) {
            /*switch ($weight['count']) {
                case $weight['count'] == 0: $type = 'important'; break;
                case $weight['count'] < 4: $type = 'warning'; break;
                default: $type = 'info';
            }*/
            if ($weight['count'] == 0) $type = 'important';
            else if ($weight['count'] < 4)  $type = 'warning';
            else $type = 'default';
            $count = $this->widget('bootstrap.widgets.TbBadge', array(
                'type'=>$type, // 'success', 'warning', 'important', 'info' or 'inverse'
                'label'=>$weight['count'],
            ), true);
            
            $content = $weight['text']. ' - ' . $count . ', ';
            $weigths .= $content;
        }
        
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data'=>array('id'=>$aid, 'name'=>$age['text'], 'weigths'=>$weigths),
            'attributes'=>array(
                array('name'=>'name', 'label'=>'Возрастная категория'),
                array('name'=>'weigths', 'label'=>'Кол-во', 'type'=>'html', 'htmlOptions' => array('style'=>'width: 64px;')),
            ),
        ));
    }
    
    /*$gridDataProvider = new CArrayDataProvider(
        array(
            array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS'),
            array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript'),
            array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML'),
        )
        $weigth_arr
    ); */
    
    

    /*$this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}",
        'columns'=>$columns array(
            array('name'=>'id', 'header'=>'#'),
            array('name'=>'firstName', 'header'=>'First name'),
            array('name'=>'lastName', 'header'=>'Last name'),
            array('name'=>'language', 'header'=>'Language'),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
        ),  
    )); */
  
} else {  
?>
<p style="color: maroon; font-weight: bold;">Внимание! Списки спортсменов по категориям временно не отображаются. Просим прощения за временные неудобства...</p>
<?php } ?>

</div>
