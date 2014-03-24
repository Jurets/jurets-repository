<style type="text/css">
    body {
        font-size: 12px;
        line-height: 16px;
    }
    
.text23 {
    font-size: 20px;
    line-height: 16px;
}    
</style>

<?php //DebugBreak();
    //echo $model->invitation;  
    //echo $model->path;  
    $cmd = Yii::app()->db->createCommand('select invitation from competition where id = :id');
    $invit = $cmd->queryScalar(array('id'=>$model->id));
    echo $invit;
?>
