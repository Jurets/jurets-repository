<?php
    $this->breadcrumbs=array(
        'Количество участников по категориям',
    );
    $age_array = array();
    $totalCount = 0;
    $id = 0;
?>

<?php
  //вывести кол-во по категориям  
    $categoryContent = '';
    foreach ($arrcategory as $aid=>$age) {
        $ageCount = 0;
        //посчитать кол-во участников по возрастной
        foreach ($age['children'] as $weight) {
            $ageCount += $weight['count'];
        }
        $age_array[] = array('id'=>++$id, 'name'=>$age['text'], 'count'=>$ageCount);
        $totalCount += $ageCount;
        //отрендерить вьюшку по одной возрастной        
        $categoryContent .= $this->renderPartial('_statage', array('age'=>$age), true);
    }
    $age_array[] = array('id'=>'', 'name'=>'ИТОГО', 'weigths'=>null, 'count'=>$totalCount);
    
    //легенда
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
            /*array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ), */
        ),  
    ), true); 
  
    //ТабВью: показать на вкладках раздельно 
    $this->widget('bootstrap.widgets.TbTabs', array(
        //'skin'=>'default',
        'id'=>'category-stat',
        'type'=>'tabs', //'pills'
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array('label'=>Yii::t('fullnames', 'В разрезе'), 'content'=>$categoryContent, 'active'=>true),
            array('label'=>Yii::t('fullnames', 'Суммарно'), 'content'=>$summaryContent, 'active'=>false/*($tabnum == 2)*/),
        ),
    ));
?>
