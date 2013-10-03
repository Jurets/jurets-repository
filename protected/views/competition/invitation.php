<?php //DebugBreak();
    //echo $model->invitation;  
    //echo $model->path;  
    $cmd = Yii::app()->db->createCommand('select invitation from competition where id = :id');
    $invit = $cmd->queryScalar(array('id'=>$model->id));
    echo $invit;
?>
