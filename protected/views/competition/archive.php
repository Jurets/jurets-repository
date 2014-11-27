<style type="text/css">
h3 {
    font-size: 18px;
}
</style>

<?php
$docpath = Yii::app()->baseUrl.'/document/result/';

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Archive'),
);

?>


<!--<h1>Архив результатов соревнований</h1>-->
<!--<p><?php echo Yii::t('fullnames', 'This page will be published results of the championship')?></p>-->
<!--<p>Чтобы скачать необходимый протокол - выберите тип документа (Распаровка или Результат), затем нужную возрастную категорию и кликните по соответствующей ссылке ниже</p>-->

<h3>OLIMPIC STAR - 2014 (Полтава)</h3>
<?php $doc_star2014 = $docpath . DIRECTORY_SEPARATOR . 'olimpic2014' . DIRECTORY_SEPARATOR; ?>
<p>Розпаровки</p>
<a href="<?php echo $doc_star2014.'olimpic2014_draws_child(2007).pdf'?>" target="_blank" style="color: maroon; ">Дети (2007 г.р.)</a><br>
<a href="<?php echo $doc_star2014.'olimpic2014_draws_smyoung(2005-2006).pdf'?>" target="_blank" style="color: maroon; ">Младшие юноши (2005 - 2006 г.р.)</a><br>
<a href="<?php echo $doc_star2014.'olimpic2014_draws_young(2003-2004).pdf'?>" target="_blank" style="color: maroon; ">Юноши (2003 - 2004 р.н.) категорія А</a><br>
<a href="<?php echo $doc_star2014.'olimpic2014_draws_cadet(2000-2002).pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a><br>
<a href="<?php echo $doc_star2014.'olimpic2014_draws_junior(1997-1999).pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 1999 г.р.)</a><br>
<br>

<p>Результати</p>
<a href="<?php echo $doc_star2014.'olimpic2014_result_child(2007).pdf'?>" target="_blank" style="color: maroon; ">Дети (2007 г.р.)</a><br>
<a href="<?php echo $doc_star2014.'olimpic2014_result_smyoung(2005-2006).pdf'?>" target="_blank" style="color: maroon; ">Младшие юноши (2005 - 2006 г.р.)</a><br>
<a href="<?php echo $doc_star2014.'olimpic2014_result_young(2003-2004).pdf'?>" target="_blank" style="color: maroon; ">Юноши (2003 - 2004 р.н.) категорія А</a><br>
<a href="<?php echo $doc_star2014.'olimpic2014_result_cadet(2000-2002).pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a><br>
<a href="<?php echo $doc_star2014.'olimpic2014_result_junior(1997-1999).pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 1999 г.р.)</a><br>


<a name="vinnitza2014"></a>
<h3>Чемпіонат України серед ДЮСШ, СДЮСШОР та клубів  з тхеквондо (ВТФ) - 2014</h3>
<?php $doc_v2014 = $docpath . DIRECTORY_SEPARATOR . 'vinnitza2014' . DIRECTORY_SEPARATOR; ?>
<p>Юнаки (2003 - 2004 р.н.)</p>
<ul>
    <li>Розпаровки М: 
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-24kg.pdf'?>">-24 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-26kg.pdf'?>">-26 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-28kg.pdf'?>">-28 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-30kg.pdf'?>">-30 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-32kg.pdf'?>">-32 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-34kg.pdf'?>">-34 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-37kg.pdf'?>">-37 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-41kg.pdf'?>">-41 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-45kg.pdf'?>">-45 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-50kg.pdf'?>">-50 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male-55kg.pdf'?>">-55 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_male+55kg.pdf'?>">+55 кг</a>,
    </li>
    <li>Розпаровки Ж: 
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-28kg.pdf'?>">-28 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-30kg.pdf'?>">-30 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-32kg.pdf'?>">-32 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-34kg.pdf'?>">-34 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-37kg.pdf'?>">-37 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-41kg.pdf'?>">-41 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-45kg.pdf'?>">-45 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-50kg.pdf'?>">-50 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'young_female-55kg.pdf'?>">-55 кг</a>,
    </li>
</ul>
<p>Кадети (2000 - 2002 р.н.)</p>
<ul>
    <li>Розпаровки М: 
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-33kg.pdf'?>">-33 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-37kg.pdf'?>">-37 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-41kg.pdf'?>">-41 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-45kg.pdf'?>">-45 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-49kg.pdf'?>">-49 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-53kg.pdf'?>">-53 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-57kg.pdf'?>">-57 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-61kg.pdf'?>">-61 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male-65kg.pdf'?>">-65 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_male+65kg.pdf'?>">+65 кг</a>,
    </li>
    <li>Розпаровки Ж: 
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_female-37kg.pdf'?>">-37 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_female-41kg.pdf'?>">-41 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_female-44kg.pdf'?>">-44 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_female-47kg.pdf'?>">-47 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_female-55kg.pdf'?>">-55 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_female-59kg.pdf'?>">-59 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'cadet_female+59kg.pdf'?>">+59 кг</a>,
    </li>
</ul>
<p>Юніори (1997 - 1999 р.н.)</p>
<ul>
    <li>Розпаровки М: 
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_male-48kg.pdf'?>">-48 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_male-51kg.pdf'?>">-51 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_male-55kg.pdf'?>">-55 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_male-59kg.pdf'?>">-59 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_male-63kg.pdf'?>">-63 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_male-68kg.pdf'?>">-68 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_male-73kg.pdf'?>">-73 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_male-78kg.pdf'?>">-78 кг</a>,
    </li>
    <li>Розпаровки Ж: 
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_female-46kg.pdf'?>">-46 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_female-49kg.pdf'?>">-49 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_female-52kg.pdf'?>">-52 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_female-55kg.pdf'?>">-55 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_female-59kg.pdf'?>">-59 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_female-63kg.pdf'?>">-63 кг</a>,
        <a target="_blank" style="color: maroon;" href="<?php echo $doc_v2014.'junior_female-68kg.pdf'?>">-68 кг</a>,
    </li>
</ul>


<h3>Відкритий чемпіонат Мереф'янської ДЮСШ Харківської районної ради Харківської області з тхеквондо (ВТФ)</h3>
<p>Розпаровки</p>
<a id="all-download" href="<?php echo $docpath.'merefa2014_restoss_child(2007).pdf'?>" target="_blank" style="color: maroon; ">Діти (2007 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'merefa2014_restoss_smyoung(2005-2006).pdf'?>" target="_blank" style="color: maroon; ">Молодші юнаки (2005 - 2006 р.н.)</a> <br>
<a id="all-download" href="<?php echo $docpath.'merefa2014_restoss_young(2003-2004).pdf'?>" target="_blank" style="color: maroon; ">Юнаки (2003 - 2004 р.н.)</a> <br>
<a id="all-download" href="<?php echo $docpath.'merefa2014_restoss_cadet(2000-2002).pdf'?>" target="_blank" style="color: maroon; ">Кадети (2000 - 2002 р.н.)</a><br>
<a id="all-download" href="<?php echo $docpath.'merefa2014_restoss_junior(1997-1999).pdf'?>" target="_blank" style="color: maroon; ">Юніори (1997 - 1999 р.н.)</a><br><br>

<p>Результати</p>
<a id="all-download" href="<?php echo $docpath.'merefa2014_res_child(2007).pdf'?>" target="_blank" style="color: maroon; ">Діти (2007 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'merefa2014_res_smyoung(2005-2006).pdf'?>" target="_blank" style="color: maroon; ">Молодші юнаки (2005 - 2006 р.н.)</a><br>
<a id="all-download" href="<?php echo $docpath.'merefa2014_res_young(2003-2004).pdf'?>" target="_blank" style="color: maroon; ">Юнаки (2003 - 2004 р.н.)</a><br>
<a id="all-download" href="<?php echo $docpath.'merefa2014_res_cadet(2000-2002).pdf'?>" target="_blank" style="color: maroon; ">Кадети (2000 - 2002 р.н.)</a><br>
<a id="all-download" href="<?php echo $docpath.'merefa2014_res_junior(1997-1999).pdf'?>" target="_blank" style="color: maroon; ">Юніори (1997 - 1999 р.н.)</a><br>


<h3>Открытый кубок КЗ КДЮСШ «ХТЗ» ХОР 2014, сентябрь (Харьков)</h3>
<p>Сетки</p>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_restoss_child(2007).pdf'?>" target="_blank" style="color: maroon; ">Дети (2007 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_restoss_smyoung(2005-2006).pdf'?>" target="_blank" style="color: maroon; ">Младшие юноши (2005 - 2006 г.р.)</a> <br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_restoss_young(2003-2004).pdf'?>" target="_blank" style="color: maroon; ">Юноши (2003 - 2004 р.н.) категорія А</a> <br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_restoss_cadet(2000-2002).pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_restoss_junior(1997-1999).pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 1999 г.р.)</a><br><br>

<p>Результаты</p>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_res_child(2007).pdf'?>" target="_blank" style="color: maroon; ">Дети (2007 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_res_smyoung(2005-2006).pdf'?>" target="_blank" style="color: maroon; ">Младшие юноши (2005 - 2006 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_res_young(2003-2004).pdf'?>" target="_blank" style="color: maroon; ">Юноши (2003 - 2004 р.н.) категорія А</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_res_cadet(2000-2002).pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014sep_res_junior(1997-1999).pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 1999 г.р.)</a><br>


<a name="htz2014apr"></a>
<h3>Открытый кубок КЗ КДЮСШ «ХТЗ» ХОР 2014, апрель (Харьков)</h3>
<p>Сетки</p>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_restoss_child.pdf'?>" target="_blank" style="color: maroon; ">Дети (2007 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_restoss_smyoung.pdf'?>" target="_blank" style="color: maroon; ">Младшие юноши (2005 - 2006 г.р.)</a> <br>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_restoss_young.pdf'?>" target="_blank" style="color: maroon; ">Юноши (2003 - 2004 р.н.) категорія А</a> <br>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_restoss_cadet.pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_restoss_junior.pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 1999 г.р.)</a><br><br>

<p>Результаты</p>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_res_child.pdf'?>" target="_blank" style="color: maroon; ">Дети (2007 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_res_smyoung.pdf'?>" target="_blank" style="color: maroon; ">Младшие юноши (2005 - 2006 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_res_young.pdf'?>" target="_blank" style="color: maroon; ">Юноши (2003 - 2004 р.н.) категорія А</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_res_cadet.pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'htz2014apr_res_junior.pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 1999 г.р.)</a><br>


<h3>Кубок Карпат 2014 (Ивано-Франковск)</h3>

<p>Распаровки:</p>
<a id="all-download" href="<?php echo $docpath.'IF2014-child_toss.pdf'?>" target="_blank" style="color: maroon; ">Діти (2005 - 2006 р.н.) категорія А</a><br>
<a id="all-download" href="<?php echo $docpath.'IF2014-young_toss.pdf'?>" target="_blank" style="color: maroon; ">Юнаки (2002 - 2004 р.н.) категорія А</a><br>
<a id="all-download" href="<?php echo $docpath.'IF2014-cadet_toss.pdf'?>" target="_blank" style="color: maroon; ">Кадети (2000 - 2002 р.н.)</a><br>
<a id="all-download" href="<?php echo $docpath.'IF2014-junior_toss.pdf'?>" target="_blank" style="color: maroon; ">Юніори (1997 - 2000 р.н.)</a><br>
<a id="all-download" href="<?php echo $docpath.'IF2014-senior_toss.pdf'?>" target="_blank" style="color: maroon; ">Молодь (1994 - 1998 р.н.)</a><br>
<br>
<p>Результати:</p>
<a id="all-download" href="<?php echo $docpath.'IF2014-child_result.pdf'?>" target="_blank" style="color: maroon; ">Діти (2005 - 2006 р.н.) категорія А</a><br>
<a id="all-download" href="<?php echo $docpath.'IF2014-young_result.pdf'?>" target="_blank" style="color: maroon; ">Юнаки (2002 - 2004 р.н.) категорія А</a><br>
<a id="all-download" href="<?php echo $docpath.'IF2014-cadet_result.pdf'?>" target="_blank" style="color: maroon; ">Кадети (2000 - 2002 р.н.)</a><br>
<a id="all-download" href="<?php echo $docpath.'IF2014-junior_result.pdf'?>" target="_blank" style="color: maroon; ">Юніори (1997 - 2000 р.н.)</a><br>
<a id="all-download" href="<?php echo $docpath.'IF2014-senior_toss.pdf'?>" target="_blank" style="color: maroon; ">Молодь (1994 - 1998 р.н.)</a>
<br><br>

<h3>Чемпіонат КДЮСШ «ХТЗ» 2014 (Харьков)</h3>

<p>Распаровки:</p>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_toss_CHILD.pdf'?>" target="_blank" style="color: maroon; ">Дети (2004 - 2006 г.р.) категория А</a><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_toss_YOUNG.pdf'?>" target="_blank" style="color: maroon; ">Юноши (2002 - 2004 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_toss_CADET.pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_toss_JUNIOR.pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 2000 г.р.)</a><br><br>

<p>Результаты:</p>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_CHILD.pdf'?>" target="_blank" style="color: maroon; ">Дети (2004 - 2006 г.р.) категория А</a><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_YOUNG.pdf'?>" target="_blank" style="color: maroon; ">Юноши (2002 - 2004 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_CADET.pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_JUNIOR.pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 2000 г.р.)</a><br><br>

<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_COMMAND.pdf'?>" target="_blank" style="color: maroon; ">Командные результаты</a>
