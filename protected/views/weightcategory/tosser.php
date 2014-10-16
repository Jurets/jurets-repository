<?php
//DebugBreak();

$cssFile = Yii::app()->baseUrl . '/css/tosser.css';
Yii::app()->clientScript->registerCssFile($cssFile);


$this->breadcrumbs=array(
    'Жеребьевка',
);

$docpath = Yii::app()->baseUrl.'/document/';
?>

<!--<h1 id="tosser-head">Попереднє жеребкування</h1>-->
<h1 id="tosser-head">Предварительная жеребьевка</h1>
<p><?php echo Yii::t('fullnames', 'On this page will be posted preliminary draws')?></p>

<!--<p style="color: red; font-weight: bold;">Вниманию представителей команд! Проверьте наличие и категорию своих спортсменов</p>

<a id="all-download" href="<?php echo $docpath.'htz2014sep_toss_child(2007).pdf'?>" target="_blank" style="color: maroon; ">Дети (2007 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_toss_smyoung(2005-2006).pdf'?>" target="_blank" style="color: maroon; ">Младшие юноши (2005 - 2006 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_toss_young(2003-2004).pdf'?>" target="_blank" style="color: maroon; ">Юноши (2003 - 2004 р.н.) категорія А</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_toss_cadet(2000-2002).pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_toss_junior(1997-1999).pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 1999 г.р.)</a>
<br><br>-->

<!--<a id="all-download" href="<?php echo $docpath.'IF2014_senior.pdf'?>" target="_blank" style="color: maroon; ">Молодь (1994 - 1998 р.н.)</a>
<br><br>-->

<!--<a id="all-download" href="<?php echo $docpath.'all.zip'?>" style="color: maroon; font-weight: bold;">Списки по весовым</a>
<br><br>-->

<!--<p style="color: maroon; font-weight: bold;">Скачать все протоколы жеребьевки в архиве ZIP будет возможно позже</p>-->
<!--<p style="color: maroon; font-weight: bold;">Протоколы жеребьевки можно будет скачать в пятницу 25.04.2014 </p>-->


<!--<p>Для просмотра списка спортсменов весовой категории выберите нужную вкладку с возрастной категорией (горизонтальный список вверху), 
а затем нужную весовую категорию (вертикальный список слева): справа отобразится список спортсменов выбранной весовой категории</p>-->

<!--<p style="color: maroon; font-weight: bold;">Скачать все протоколы жеребьевки в архиве ZIP будет возможно позже</p>-->

<div id="age-categories">


<?php

if (false) {  /////////////////////////////////////ВРЕМЕННО!!!!!!
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
<?php } } ?>

</div>

<!--<p style="color: red; font-weight: bold;">До уваги представників команд! Перевірте наявність та категорію своїх спортсменів</p>-->


<!--<p>Чтобы скачать необходимый протокол - выберите тип документа (Распаровка или Результат), затем нужную возрастную категорию и кликните по соответствующей ссылке ниже</p>-->
<!--<p>Щоб скачати необхідний протокол - оберіть потрібну вікову групу:</p>
<a id="all-download" href="<?php echo $docpath.'IF2014_child.pdf'?>" target="_blank" style="color: maroon; ">Діти (2005 - 2006 р.н.) категорія А</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'IF2014_young.pdf'?>" target="_blank" style="color: maroon; ">Юнаки (2002 - 2004 р.н.) категорія А</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'IF2014_cadet.pdf'?>" target="_blank" style="color: maroon; ">Кадети (2000 - 2002 р.н.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'IF2014_junior.pdf'?>" target="_blank" style="color: maroon; ">Юніори (1997 - 2000 р.н.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'IF2014_senior.pdf'?>" target="_blank" style="color: maroon; ">Молодь (1994 - 1998 р.н.)</a>
<br><br>-->

<!--
<p>Чтобы скачать необходимый протокол - выберите нужную возрастную категорию и кликните по соответствующей ссылке ниже:</p>

<h3>Дети (2003 - 2005 г.р.) категория А</h3>
<table>
<tr><td valign="top" width="250">
    <a id="all-download" href="<?php echo $docpath.'child_m_22.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 22 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_24.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 24 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_26.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 26 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_28.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 28 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_30.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 30 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_32.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 32 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_34.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 34 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_37.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 37 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_41.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 41 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_41+.pdf'?>" target="_blank" style="color: maroon; ">Мальчики свыше 41 кг</a><br>
</td>
<td width="50"></td>
<td valign="top" width="250">
    <a id="all-download" href="<?php echo $docpath.'child_f_24.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 24 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_26.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 26 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_28.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 28 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_32.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 32 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_37.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 37 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_41+.pdf'?>" target="_blank" style="color: maroon; ">Девочки свыше 41 кг (объединённая)</a><br>
</td>
</table>

<h3>Юноши (2001 - 2003 г.р.)</h3>
<table>
<tr><td valign="top" width="250">
    <a id="all-download" href="<?php echo $docpath.'young_m_28.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 28 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_30.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 30 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_32.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 32 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_34.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 34 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_37.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 37 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_41.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 41 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_45.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 45 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_50.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 50 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_ 50+.pdf'?>" target="_blank" style="color: maroon; ">Юноши свыше 50 кг</a><br>
</td>
<td width="50"></td>
<td valign="top" width="250">
    <a id="all-download" href="<?php echo $docpath.'young_f_30.pdf'?>" target="_blank" style="color: maroon; ">Девушки до 30 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_f_37.pdf'?>" target="_blank" style="color: maroon; ">Девушки до 37 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_f_45.pdf'?>" target="_blank" style="color: maroon; ">Девушки до 45 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_f_50+.pdf'?>" target="_blank" style="color: maroon; ">Девушки свыше 50 кг</a><br>
</td>
</table>

<h3>Кадеты (1999 - 2001 г.р.)</h3>
<table>
<tr><td valign="top" width="250">
    <a id="all-download" href="<?php echo $docpath.'cadet_m_33.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 33 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_37.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 37 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_41.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 41 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_45.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 45 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_49.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 49 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_53.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 53 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_57.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 57 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_61.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 61 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_65+.pdf'?>" target="_blank" style="color: maroon; ">Кадеты свыше 65 кг</a><br>
</td>
<td width="50"></td>
<td valign="top" width="250">
    <a id="all-download" href="<?php echo $docpath.'cadet_f_41.pdf'?>" target="_blank" style="color: maroon; ">Кадетки до 41 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_f_47.pdf'?>" target="_blank" style="color: maroon; ">Кадетки до 47 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_f_59.pdf'?>" target="_blank" style="color: maroon; ">Кадетки до 59 кг (объединённая)</a><br>
</td>
</table>

<h3>Юниоры (1996 - 1999 г.р.)</h3>
<table>
<tr><td valign="top" width="250">
    <a id="all-download" href="<?php echo $docpath.'junior_m_45.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 45 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_51.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 51 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_55.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 55 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_63.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 63 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_73.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 73 кг (объединённая)</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_78+.pdf'?>" target="_blank" style="color: maroon; ">Юниоры свыше 78 кг</a><br>
</td>
<td width="50" width="250"></td>
<td valign="top">
    <a id="all-download" href="<?php echo $docpath.'junior_f_55.pdf'?>" target="_blank" style="color: maroon; ">Юниорки до 55 кг (объединённая)</a><br>
</td>
</table>
       -->

<!--<h3>Дети (2003 - 2005 г.р.) категория А</h3>
    <a id="all-download" href="<?php echo $docpath.'child_m_22.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 22 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_24.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 24 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_26.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 26 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_28.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 28 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_30.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 30 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_32.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 32 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_34.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 34 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_37.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 37 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_41.pdf'?>" target="_blank" style="color: maroon; ">Мальчики до 41 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_m_41+.pdf'?>" target="_blank" style="color: maroon; ">Мальчики свыше 41 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_24.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 24 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_26.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 26 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_28.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 28 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_32.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 32 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_37.pdf'?>" target="_blank" style="color: maroon; ">Девочки до 37 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'child_f_41+.pdf'?>" target="_blank" style="color: maroon; ">Девочки свыше 41 кг</a><br>
<br>
<h3>Юноши (2001 - 2003 г.р.)</h3>
    <a id="all-download" href="<?php echo $docpath.'young_m_28.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 28 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_30.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 30 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_32.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 32 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_34.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 34 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_37.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 37 кг</a><br>
    <a id="all-" href="<?php echo $docpath.'young_m_41.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 41 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_45.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 45 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_50.pdf'?>" target="_blank" style="color: maroon; ">Юноши до 50 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_m_ 50+.pdf'?>" target="_blank" style="color: maroon; ">Юноши свыше 50 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_f_30.pdf'?>" target="_blank" style="color: maroon; ">Девушки до 30 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_f_37.pdf'?>" target="_blank" style="color: maroon; ">Девушки до 37 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_f_45.pdf'?>" target="_blank" style="color: maroon; ">Девушки до 45 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'young_f_50+.pdf'?>" target="_blank" style="color: maroon; ">Девушки свыше 50 кг</a><br>
<br>
<h3>Кадеты (1999 - 2001 г.р.)</h3>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_33.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 33 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_37.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 37 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_41.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 41 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_45.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 45 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_49.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 49 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_53.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 53 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_57.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 57 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_61.pdf'?>" target="_blank" style="color: maroon; ">Кадеты до 61 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_m_65+.pdf'?>" target="_blank" style="color: maroon; ">Кадеты свыше 65 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_f_41.pdf'?>" target="_blank" style="color: maroon; ">Кадетки до 41 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_f_47.pdf'?>" target="_blank" style="color: maroon; ">Кадетки до 47 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'cadet_f_59.pdf'?>" target="_blank" style="color: maroon; ">Кадетки до 59 кг</a><br>
<br>
<h3>Юниоры (1996 - 1999 г.р.)</h3>
    <a id="all-download" href="<?php echo $docpath.'junior_m_45.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 45 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_51.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 51 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_55.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 55 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_63.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 63 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_73.pdf'?>" target="_blank" style="color: maroon; ">Юниоры до 73 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_m_78+.pdf'?>" target="_blank" style="color: maroon; ">Юниоры свыше 78 кг</a><br>
    <a id="all-download" href="<?php echo $docpath.'junior_f_55.pdf'?>" target="_blank" style="color: maroon; ">Юниорки до 55 кг</a><br>
-->