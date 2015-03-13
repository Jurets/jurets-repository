<?php
$cssFile = Yii::app()->baseUrl . '/css/tosser.css';
Yii::app()->clientScript->registerCssFile($cssFile);

$this->breadcrumbs=array(
    'Жеребьевка',
);
// папки
$docpath = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'document';
$doc_tosser = $docpath . DIRECTORY_SEPARATOR . 'tosser' . DIRECTORY_SEPARATOR; 

if ($competition->tosserstatus == Weightcategory::TOSSER_NEW) {
    Yii::app()->user->setFlash('info', Yii::t('fullnames', 'On this page will be posted preliminary draws'));
} else if ($competition->tosserstatus == Weightcategory::TOSSER_ACTIVE) {
    Yii::app()->user->setFlash('warning', '<strong>Вниманию представителей команд!</strong> Проверьте наличие и категорию своих спортсменов');
}
//Yii::app()->user->setFlash('info', 'Остальные распаровки в процессе обработки... Скачать их можно будет в течение ближайшего времени.');


// вывести первый алерт
$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>"&times;", // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    ));
?>

<h1 id="tosser-head">Предварительная жеребьевка</h1>

<?php
    // вывести содержимое страницы
    if ($competition->tosserstatus == Weightcategory::TOSSER_ACTIVE) {
        echo $competition->tossercontent;
    }
    
    // вывести второй алерт
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); 

    // кнопки управления (для админов)
    if (Yii::app()->user->isExtendRole()) {
        echo CHtml::tag('a', array(
            'href'=>Yii::app()->createUrl('/competition/tosserupdate'),
            'class'=>'btn btn-primary',
            'title'=>Yii::t('controls', 'Edit')
        ), Yii::t('controls','Update'));
    }
?>
    
<!--<p style="color: maroon; font-weight: bold;">Протоколы жеребьевки можно будет скачать в пятницу 25.04.2014 </p>-->

<!--<p>Для просмотра списка спортсменов весовой категории выберите нужную вкладку с возрастной категорией (горизонтальный список вверху), 
а затем нужную весовую категорию (вертикальный список слева): справа отобразится список спортсменов выбранной весовой категории</p>-->

<!--<p style="color: maroon; font-weight: bold;">Скачать все протоколы жеребьевки в архиве ZIP будет возможно позже</p>-->

<!--<p style="color: red; font-weight: bold;">До уваги представників команд! Перевірте наявність та категорію своїх спортсменів</p>-->


<!--<p>Чтобы скачать необходимый протокол - выберите тип документа (Распаровка или Результат), затем нужную возрастную категорию и кликните по соответствующей ссылке ниже</p>
<p>Щоб скачати необхідний протокол - оберіть потрібну вікову групу:</p>-->
