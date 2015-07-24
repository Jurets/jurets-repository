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

<?php 
    //echo $model->invitation;  
    //echo $model->path;  
    $competition = Competition::getModel();
    
    if ($competition->type == Competition::TYPE_MAIN)
    {
        $competition = New Competition();
        $dataProvider = $competition->search();
        
        // вывод левого сайд-бара
        $this->widget('application.widgets.sidebar.SideBar'); ?>
        
        <div id="contentText" style="border: 2px solid #A6D9D5 !important; background: none !important; padding: 10px;">
        
            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'application.views.competition._item2',   // refers to the partial view named '_post'
                'tagName'=>'div',
                'itemsTagName'=>'ul',
                'itemsCssClass' => 'media-list'
                /*'sortableAttributes'=>array(
                    'title',
                    'create_time'=>'Post Time',
                ),*/
            )); ?>
        
        </div>
    <?php } else if ($competition->type == Competition::TYPE_COMPETITION) {
        //$cmd = Yii::app()->db->createCommand('select invitation from competition where id = :id');
        //$invit = $cmd->queryScalar(array('id'=>$model->id));
        //echo $invit;
        echo $competition->invitation;
    }
?>