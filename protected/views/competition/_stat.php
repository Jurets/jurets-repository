<div class="form">
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'stat-grid',
    'dataProvider'=>$dataStat,
    //'template'=>"{pager}<br>{items}<br>{pager}",
    'template'=>"{items}",
    'columns'=>array(
        array(
            'header'=>Yii::t('fullnames', 'Parameter'),
            'name'=>'statname',
        ),
        array(
            'header'=>Yii::t('fullnames', 'Value'),
            'name'=>'statvalue',
        ),
    ),
));
?>
</div>


