<?php
//DebugBreak();

$cssFile = Yii::app()->baseUrl . '/css/tosser.css';
Yii::app()->clientScript->registerCssFile($cssFile);


$this->breadcrumbs=array(
    'Жеребьевка',
);

$docpath = Yii::app()->baseUrl.'/document/';
?>

<h1 id="tosser-head">Предварительная жеребьевка</h1>

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
        foreach ($age['children'] as $wid=>$weight) { //DebugBreak();
            //$weigthcontent = $weight['sportsmens'];
            $weigthcontent = $this->renderPartial('_figthgrid', array(
                'levelcount'=>$weight['levelcount'],
                'tosserGrid'=>$weight['tosserGrid'],    //сетка
                'tosserManager'=>$tosserManager,
                'sportsmens'=>$weight['sportsmens'],
            ), true, false);
            $sp_count = $weight['sportsmencount'];   //кол-во спортсменов
            $sp_count = ($sp_count > 0) ? '('.$sp_count.')' : '';  //показать кол-во на лабеле вкладки
            $weigths[] = array('label'=>$weight['text'].$sp_count, 'content'=>$weigthcontent, 'active'=>!$wid);
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
} else { 
?>
<p style="color: maroon; font-weight: bold;">Внимание! Списки спортсменов по категориям временно не отображаются. Просим прощения за временные неудобства...</p>
<?php } ?>

</div>

<!--<p>Чтобы скачать необходимый протокол - выберите тип документа (Распаровка или Результат), затем нужную возрастную категорию и кликните по соответствующей ссылке ниже</p>-->

<p>Чтобы скачать необходимый протокол - выберите нужную возрастную категорию и кликните по соответствующей ссылке ниже:</p>
<a id="all-download" href="<?php echo $docpath.'p_child.pdf'?>" target="_blank" style="color: maroon; ">Дети (2003 - 2005 г.р.) категория А</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'p_young.pdf'?>" target="_blank" style="color: maroon; ">Юноши (2001 - 2003 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'p_cadet.pdf'?>" target="_blank" style="color: maroon; ">Кадеты (1999 - 2001 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'p_junior.pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1996 - 1999 г.р.)</a>
<br><br>
