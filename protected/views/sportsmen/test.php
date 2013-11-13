<?php

 $this->beginWidget('zii.widgets.jui.CJuiDraggable',array(
    'id' => 'my_id1',
    'htmlOptions' => array(
        'class'=>'my_class',
    ),
    'options'=>array(
        //'scope'=>'myScope',
        'opacity'=>'0.35',
        'revert'=>'invalid',
        'helper'=>'clone',
        'accept' => '.my_class',
    ),
 ));
 echo('объект для таскания');
 $this->endWidget();

 
 $this->beginWidget('zii.widgets.jui.CJuiDraggable',array(
    'id' => 'my_id2',
    'htmlOptions' => array(
        'class'=>'my_class',
    ),
    'options'=>array(
        //'scope'=>'myScope',
        'opacity'=>'0.35',
        'revert'=>'invalid',
        'helper'=>'clone',
        'accept' => '.my_class',
    ),
 ));
 echo('объект для таскания');
 $this->endWidget();
 
 $this->beginwidget('zii.widgets.jui.CJuiDroppable', array(
  'id' => 'my_target',
  'options' => array(
   //'accept' => 'my_id',
   //'url'    => 'index.php?r=site/contact', 
   'hoverClass'=> 'dropped',
   'drop'=>'js:function(){alert("hello");}',
 //  'over'=>'js:function(){alert("hello");}',
   //'drop' =>'index.php?r=site/contact', 
  )
 ));
 echo('ЗОНА ПОСАДКИ');
 $this->endwidget(); 
?>


<style type="text/css">
.my_class{
 width: 200px;
 height: 50px;
 background: #90d0d0;
 
}

#my_target{
 width: 700px;
 height: 200px;
 background: #eeeeee;
}

.dropped{
 background: #aa00aa;
}

</style>