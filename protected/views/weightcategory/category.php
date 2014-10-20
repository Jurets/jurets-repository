<style type="text/css">
    .detail-view th {
        width: 60px;
    }

    .table {
        font-size: 12px;
    }    
</style>
<?php
    $this->breadcrumbs=array(
        'Количество участников по категориям',
    );
    //$weigth_arr = array();
    //$columns = array();
    $age_array = array();
    $totalCount = 0;
    $id = 0;
    
  //вывести кол-во по категориям  
    $categoryContent = '';
    foreach ($arrcategory as $aid=>$age) {
        $categoryContent .= $this->widget('bootstrap.widgets.TbLabel', array(
            'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
            'label'=>$age['text'],
        ), true);
        
        $weigths = '';
        $ageCount = 0;
        foreach ($age['children'] as $wid=>$weight) {
            if ($weight['count'] == 0) 
                $type = 'default';//'important';
            else if ($weight['count'] == 1) 
                $type = 'important';  //'error';
            else if ($weight['count'] < 4) 
                $type = 'warning';//'warning';
            else 
                $type = 'success'; //'default';
            $count = $this->widget('bootstrap.widgets.TbBadge', array(
                'type'=>$type, // 'success', 'warning', 'important', 'info' or 'inverse'
                'label'=>$weight['count'],
            ), true);
            
            $ageCount += $weight['count'];
            
            $content = $weight['text']. ' - ' . $count . ', ';
            $weigths .= $content;
        }
        
        $data = array('id'=>++$id, 'name'=>$age['text'], 'weigths'=>$weigths, 'count'=>$ageCount);
        $age_array[] = $data;
        
        $categoryContent .= $this->widget('bootstrap.widgets.TbDetailView', array(
            'data'=>$data, 
            'attributes'=>array(
                //array('name'=>'name', 'label'=>'Возрастная категория'),
                //array('name'=>'count', 'label'=>'Всего'),
                array('name'=>'weigths', 'label'=>'По весам', 'type'=>'html'),
            ),
        ), true);
        $totalCount += $ageCount;
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
