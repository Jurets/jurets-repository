<?php
    //получить объект Соревнования
    $competition = Competition::getModel();
    //является ли тип соревнования "сборы"
    $isCamp = $competition->isCamp;
    $isITF = $competition->type == 'itf';
    
    //
    $this->breadcrumbs=array(
        'Количество участников по категориям',
    );
    $age_array = array();
    $totalCount = 0;
    $id = 0;

    $columns = [['header'=>'Фамилия, Имя', 'name'=>'FullName'],
                ['header'=>'Команда', 'name'=>'Commandname'],
                ['header'=>'Г.р.', 'name'=>'BirthYear'], 
                ['header'=>'Тренер', 'name'=>'Coachname']];
    
  //вывести кол-во по категориям  
    $categoryContent = '';
    foreach ($arrcategory as $aid=>$age) {
        $ageCount = 0;
        //посчитать кол-во участников по возрастной
        if (isset($age['children']) && is_array($age['children'])) {
            foreach ($age['children'] as $wid=>$weight) {
                $ageCount += $weight['count'];
                $content = '';
                if (Yii::app()->IsViewContestants) {
                    //создать источник данных (для виджета грида, который во вьюшке _weigthlist)
                    $dataProvider = new CArrayDataProvider($weight['sportsmens'], array(
                        'totalItemCount' => count($weight['sportsmens']),
                        'keyField' => false, 'pagination' => array('pageSize' => 50,),
                    ));
                    //прорендерить вьюшку _weigthlist одной весовой категории
                    $content = $this->renderPartial('/sportsmen/_weigthlist', array('dataProvider' => $dataProvider, 'weigthid' => $weight['id'], 'columns' => $columns), true, false);
                    $id = 'weigth_' . $weight['id'];
                    $title = $age['text'] . '<br>' . $weight['text'];// . ', ' . $title_division;
                    $this->renderPartial('application.views.site.blocks._modal', array('id' => $id, 'title' => $title, 'content' => $content));
                }
            }
        }
        $age_array[] = array('id'=>++$id, 'name'=>$age['text'], 'count'=>$ageCount);
        $totalCount += $ageCount;
        //отрендерить вьюшку по одной возрастной        
        //if (!$isCamp) 
        {
            $categoryContent .= $this->renderPartial('_statage', array('age'=>$age), true);
        }
    }
    $age_array[] = array('id'=>'', 'name'=>'ИТОГО', 'weigths'=>null, 'count'=>$totalCount);
    
    //легенда
    //if (!$isCamp) 
    {
        $categoryContent .= CHtml::tag('hr');
        $categoryContent .= CHtml::tag('span', array(), 'Пояснения: ', true);
        $categoryContent .= $this->widget('bootstrap.widgets.TbBadge', array('type'=>'success', 'label'=>4), true);
        $categoryContent .= CHtml::tag('span', array(), ' - нормальное кол-во  ', true);
        $categoryContent .= $this->widget('bootstrap.widgets.TbBadge', array('type'=>'warning', 'label'=>3), true);
        $categoryContent .= CHtml::tag('span', array(), ' - меньше четырёх  ', true);
        $categoryContent .= $this->widget('bootstrap.widgets.TbBadge', array('type'=>'important', 'label'=>1), true);
        $categoryContent .= CHtml::tag('span', array(), ' - один человек в категории  ', true);
        $categoryContent .= $this->widget('bootstrap.widgets.TbBadge', array('type'=>'default', 'label'=>0), true);
        $categoryContent .= CHtml::tag('span', array(), ' - пустая категория', true);
    }
        
    //общая статистика
    $gridDataProvider = new CArrayDataProvider($age_array, array(
        'pagination'=>array(
            'pageSize'=>50,
        ),
    )); 
    $summaryContent = $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}{pager}",
        'columns'=>array(
            array('name'=>'id', 'header'=>'#'),
            array('name'=>'name', 'header'=>'Возрастная категория'),
            array('name'=>'count', 'header'=>'Количество участников'),
        ),  
    ), true); 
  
    $tabs = array();
    //if (!$isCamp) 
    {
        $label = $isITF ? 'Все' : Yii::t('fullnames', 'В разрезе');
        if ($isITF) {
            // цикл по дивизионам
            for ($division = 1; $division <= 3; $division++) {
                $content = '';
                // цикл по возрастам
                foreach ($arrcategory as $aid=>$age) {
                    //$ageCount = 0;
                    //посчитать кол-во участников по возрастной
                    /*if (isset($age['children']) && is_array($age['children'])) {
                        foreach ($age['children'] as $weight) {
                            $ageCount += $weight['count'];
                        }
                    }*/
                    //$age_array[] = array('id'=>++$id, 'name'=>$age['text'], 'count'=>$ageCount);
                    //$totalCount += $ageCount;
                    //отрендерить вьюшку по одной возрастной        
                    $content .= $this->renderPartial('_statage2', array('age'=>$age, 'division'=>$division), true);

                    $title_division = $weight['divisions'][$division]['name'] . ' (' . $weight['divisions'][$division]['text'] . ')';
                    // вывести модальные окна
                    foreach ($age['children'] as $wid=>$weight) {
                        $sp_content = '';
                        foreach ($weight['divisions'][$division]['sportsmens'] as $id=>$item) {
                            $sp_content .= ($id + 1) . ') ' . $item['FullName'] . '(' . $item['Commandname'] . ")<br>";
                        }
                        /*$this->beginWidget('bootstrap.widgets.TbModal', array(
                            'id'=>'weigth_' . $weight['id'],
                            'fade'=>false,
                            'options'=>array('backdrop'=>false),
                        ));*/
                        $id = 'weigth_' . $weight['id'];
                        $title = $age['text'] . '<br>' . $weight['text'] . ', ' . $title_division;
                        if ($weight['divisions'][$division]['count'] > 0) {
                            $id .= '_' . $division;
                        }
                        $this->renderPartial('application.views.site.blocks._modal', array('id'=>$id, 'title'=>$title, 'content'=>$sp_content));
                    }
                    
                }
                $tabs[] = array(
                    'label'=>$title_division, //$division.' дивизион', 
                    'content'=>$content, 
                    'active'=>($division == 1)
                );
            }
            if (!$isITF) { // если не ИТФ, то показать таб "Все"
                $tabs[] = array('label'=>$label, 'content'=>$categoryContent, 'active'=>false);
            }
        } else {
            $tabs[] = array('label'=>$label, 'content'=>$categoryContent, 'active'=>true);
        }
        
    }
    $tabs[] = array('label'=>Yii::t('fullnames', 'Суммарно'), 'content'=>$summaryContent, 'active'=>false /*$isCamp*//*($tabnum == 2)*/);
  
    //ТабВью: показать на вкладках раздельно 
    $this->widget('bootstrap.widgets.TbTabs', array(
        //'skin'=>'default',
        'id'=>'category-stat',
        'type'=>'tabs', //'pills'
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>$tabs
    ));
?>
