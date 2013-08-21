<?php

$this->breadcrumbs=array(
    'Жеребьевка',
);

/*$this->menu=array(
    array('label'=>'Заявки', 'url'=>array('/proposal/index')),
    array('label'=>'Команды', 'url'=>array('/command/index')),
    array('label'=>'Спортсмены', 'url'=>array('/sportsmen/index')),
    array('label'=>'Тренеры', 'url'=>array('/coach/index')),
);*/

/*Yii::app()->clientScript->registerScript('toggleAgeFragment', "
function toggleAge() {
    alert(this.style);
}
//$('.search-button').click(function(){
//    $('.search-form').toggle();
//    return false;
//});
//$('.search-form form').submit(function(){
//    $.fn.yiiGridView.update('sportsmen-grid', {
//        data: $(this).serialize()
//    });
//    return false;
//});
");*/

Yii::app()->clientScript->registerCoreScript('jquery');
$docpath = Yii::app()->baseUrl.'/document/prot/';

Yii::app()->clientScript->registerScript('menuTreeClick', "
jQuery('#age-categories ul li a').click(function() {
    obj = $(this).parent();
    if (obj.hasClass('age-item')) {
        $('#age-categories ul li ul.age-shown').toggleClass('age-shown age-hidden');
        obj.children('ul').toggleClass('age-shown age-hidden');
    }
    else if (obj.hasClass('weight-item')) {
        objid = obj.attr('id');
        $('#cat-content').load('".Yii::app()->createAbsoluteUrl('/weightcategory/getweightlist')."', {'weigthid': objid});
        parobj = obj.parent().parent();
        txt = parobj.children('a').text() + ' - ' + $(this).text();
        $('#tosser-head').text(txt);
        
        href = '".$docpath."' + objid + '.xls';
        $('#tosser-download').attr('href', href);
    }
    return false;
});

$(document).ready(function() {
    jQuery('#age-categories ul li:first ul li:first a').click();
});

");
?>

<h1 id="tosser-head">Жеребьевка</h1>

<!--<a id="tosser-download" href="#" style="color: maroon; font-weight: bold;">Скачать протокол жеребьевки выбранной категории</a>
<br><br>-->

<a id="all-download" href="<?php echo $docpath.'all.zip'?>" style="color: maroon; font-weight: bold;">Скачать все протоколы жеребьевки в архиве ZIP</a>
<br><br>

<p>Для просмотра списка спортсменов весовой категории выберите в списке слева нужную возрастную категорию, 
 а затем в развернувшемся списке выберите нужную весовую категорию - справа отобразится список спортсменов выбранной весовой категории</p>
 
<style>
    #age-categories {
        width: 220px;
        float: left;
    }
    #cat-content {
        width: 690px;
        float: right;
    }
    
    .age-shown {
        display: block;
    }

    .age-hidden {
        display: none;
    }
</style> 

<div id="age-categories">

<?php

//$this->renderPartial('_view', array('model'=>$model));

/*$this->widget('CTreeView', array(
    'id'=>'age-treeview',
    'data' => $arrcategory, 
    //'toggle'=>'toggleAge',
    'htmlOptions' => array('class' => 'treeview-grey')));*/

    $iter = 0;
    echo CHtml::tag('ul', array(), null, false);
    foreach ($arrcategory as $aid=>$age) {
        echo CHtml::tag('li', array('id'=>$age['id'], 'class'=>'age-item'), null, false);
            echo CHtml::tag('a', array('href'=>'#'), $age['text'], true);
            if (count($age['children'])) {
                $class = $iter++ ? 'age-hidden' : 'age-shown';
                echo CHtml::tag('ul', array('class'=>$class), null, false);
                foreach ($age['children'] as $wid=>$weight) {
                    echo CHtml::tag('li', array('id'=>$weight['id'], 'class'=>'weight-item'), null, false);
                        echo CHtml::tag('a', array('href'=>'#'), $weight['text'], true);
                    echo CHtml::tag('/li');
                }
                echo CHtml::tag('/ul');
            }
        echo CHtml::tag('/li');
    }
    echo CHtml::tag('/ul');
?>
</div>

<div id="cat-content">
    <span>Здесь будет содержимое</span>
</div>

