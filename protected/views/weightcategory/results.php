<?php
$docpath = Yii::app()->baseUrl.'/document/result/';

$this->breadcrumbs=array(
    'Результаты',
);

?>

<h1>Результаты</h1>

<p><?php echo Yii::t('fullnames', 'This page will be published results of the championship')?></p>

<p>Чтобы скачать необходимый протокол - выберите тип документа (Распаровка или Результат), затем нужную возрастную категорию и кликните по соответствующей ссылке ниже</p>

<p>Распаровки:</p>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_toss_CHILD.pdf'?>" target="_blank" style="color: maroon; ">Дети (2004 - 2006 г.р.) категория А</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_toss_YOUNG.pdf'?>" target="_blank" style="color: maroon; ">Юноши (2002 - 2004 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_toss_CADET.pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_toss_JUNIOR.pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 2000 г.р.)</a>
<br><br>

<p>Результаты:</p>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_CHILD.pdf'?>" target="_blank" style="color: maroon; ">Дети (2004 - 2006 г.р.) категория А</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_YOUNG.pdf'?>" target="_blank" style="color: maroon; ">Юноши (2002 - 2004 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_CADET.pdf'?>" target="_blank" style="color: maroon; ">Кадеты (2000 - 2002 г.р.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'HTZ2014_result_JUNIOR.pdf'?>" target="_blank" style="color: maroon; ">Юниоры (1997 - 2000 г.р.)</a>
<br><br>

<p>Дополнительно:</p>
<a id="all-download" href="<?php echo $docpath.'teampoints.pdf'?>" target="_blank" style="color: maroon; ">Командные результаты</a>
