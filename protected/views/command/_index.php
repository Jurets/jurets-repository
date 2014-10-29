<?php
//$this->widget('zii.widgets.grid.CGridView', array(
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'command-grid',
    'template'=>"{pager}\n{items}\n{pager}",
    'type'=>'striped bordered condensed',
    'htmlOptions' => array('class' => 'table-list'),
    'rowCssClassExpression' => '($row % 2 ? "even" : "odd")." bColor pt-5 pb-5 pl-10 pr-10 mb-5"',
    //'dataProvider'=>$model->search(),
    'dataProvider'=>$dataProvider,
    //'filter'=>$model,
    'columns'=>array(
        array(
            'name'=>'CommandName',
            'type'=>'html',
            //'value'=>'CHtml::link(CHtml::encode($data->CommandName), CHtml::normalizeUrl(array("/command/view", "id"=>$data->CommandID)))',
            //'value'=>'CHtml::link(CHtml::encode($data->CommandName), Yii::app()->createAbsoluteUrl($this->grid->controller->pathCompetition . "/command/view", "id"=>$data->CommandID))',
            'value'=>'CHtml::link(CHtml::encode($data->CommandName), Yii::app()->createAbsoluteUrl($this->grid->controller->pathCompetition . "/command/view", array("id"=>$data->CommandID)))',
        ),
        array(
            'name'=>'city',
            'type'=>'raw',
            'value'=>'$data->relProposal->city',
        ),
        array(
            'name'=>'Delegate',
            'type'=>'raw',
            'value'=>'$data->relProposal->relUsers->UserFIO',
        ),
        array(
            'name'=>'sportsmenCount',
            //'type'=>'html',
            //'value'=>'$data->sportsmenCount',
            'value'=>'$data->sportsmen_count',
            'htmlOptions'=>array('style'=>'width: 100px'),
        ),
        array(
            'name'=>'coachCount',
            //'type'=>'html',
            //'value'=>'$data->coachCount',
            'value'=>'$data->coach_count',
            'htmlOptions'=>array('style'=>'width: 100px'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center'),
        ),
    ),
));  
?>
