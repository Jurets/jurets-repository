<?php //DebugBreak();
    //echo $model->invitation;  
    //echo $model->path;  
    $cmd = Yii::app()->db->createCommand('select invitation from competition where id = 0');
    $invit = $cmd->queryScalar();
    echo $invit;
?>
