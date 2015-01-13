<?php
$this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
    'heading'=>$age['text'],
    'headingOptions'=>array(
        'style'=>'font-size: 16px; line-height: 1; margin-top: 0; margin-bottom: 8px; letter-spacing: 0;',
    ),
    'htmlOptions'=>array(
        'style'=>'font-size: 12px; padding: 10px; margin-bottom: 10px; line-height: 16px; ',
    )
));
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

        $ageCount += $weight['count'];

        $sportsmens = '';
        foreach ($weight['sportsmens'] as $id=>$item) {
            $sportsmens .= ($id + 1) . ') ' . $item['FullName'] . '(' . $item['Commandname'] . ")<br>";
        }
        if (empty($sportsmens)) $sportsmens = 'Пустая категория';
        ?>
        <div style="width: 84px; margin-right: 0; float: left;">
            <?php 
            if ($weight['count']) {
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>$weight['text'],
                    'type'=>null, //'info',
                    'size'=>'mini', // null, 'large', 'small' or 'mini'
                    'htmlOptions'=>array(
                        'id'=>'btnWeigth' . $weight['id'],
                        'data-title'=>'Подсказка', 
                        //'title'=>'Нажмите чтобы показать состав', 
                        'data-content'=>$sportsmens, 
                        'rel'=>'popover', 
                        'data-placement'=>'bottom',
                        'data-original-title'=>'Состав ' . $weight['text'],
                        'data-trigger'=>'hover',
                        'data-html'=>true,
                        'style'=>'font-sise: 8px;'
                    ),
                ));
            } else {
                echo "<p>".$weight['text']."</p>";
            }
           // echo ' - ';
            
            $this->widget('bootstrap.widgets.TbBadge', array(
                'type'=>$type, // 'success', 'warning', 'important', 'info' or 'inverse'
                'encodeLabel'=>false,
                'label'=>$weight['count'],
                //'label'=>'<a href="#" rel="tooltip" title="'. $weight['text'] . '">' . $weight['count'] . '</a>',
            ));
                
            //$weigths .= $content;
            ?>
        </div>        
        <?php
    }
    echo '<br>';
$this->endWidget();

?>
<div style="overflow: hidden;"></div>