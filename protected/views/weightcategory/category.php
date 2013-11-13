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
    
   // DebugBreak();
  //вывести кол-во по категориям  
    foreach ($arrcategory as $aid=>$age) {
        $this->widget('bootstrap.widgets.TbLabel', array(
            'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
            'label'=>$age['text'],
        ));
        
        $weigths = '';
        $ageCount = 0;
        foreach ($age['children'] as $wid=>$weight) {
            if ($weight['count'] == 0) 
                $type = 'important';
            else if ($weight['count'] < 4) 
                $type = 'warning';
            else 
                $type = 'default';
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
        
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data'=>$data, 
            'attributes'=>array(
                //array('name'=>'name', 'label'=>'Возрастная категория'),
                //array('name'=>'count', 'label'=>'Всего'),
                array('name'=>'weigths', 'label'=>'По весам', 'type'=>'html'),
            ),
        ));
        $totalCount += $ageCount;
    }
    $age_array[] = array('id'=>'', 'name'=>'ИТОГО', 'weigths'=>null, 'count'=>$totalCount);
    
    $gridDataProvider = new CArrayDataProvider($age_array); 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}",
        'columns'=>array(
            array('name'=>'id', 'header'=>'#'),
            array('name'=>'name', 'header'=>'Возрастная категория'),
            array('name'=>'count', 'header'=>'Количество участников'),
            /*array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ), */
        ),  
    )); 
  
  
?>
