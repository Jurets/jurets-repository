<?php
$cssFile = Yii::app()->baseUrl . '/css/tosser.css';
Yii::app()->clientScript->registerCssFile($cssFile);

$this->breadcrumbs=array(
    'Результаты',
);
// папки
$docpath = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'document';
$doc_tosser = $docpath . DIRECTORY_SEPARATOR . 'result' . DIRECTORY_SEPARATOR; 

if ($competition->tosserstatus == Weightcategory::TOSSER_NEW) {
    Yii::app()->user->setFlash('info', Yii::t('fullnames', 'On this page will be posted results'));
} else if ($competition->tosserstatus == Weightcategory::TOSSER_ACTIVE) {
    Yii::app()->user->setFlash('warning', 'Чтобы скачать протокол жеребьевки выбранной категории - выберите нужную категорию');
} else if ($competition->tosserstatus == Weightcategory::TOSSER_WAIT) {
    Yii::app()->user->setFlash('info', 'Некоторые документы в процессе обработки... Открыть их можно будет в течение ближайшего времени.');
}

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
    if ($competition->tosserstatus != Weightcategory::TOSSER_NEW) {
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
