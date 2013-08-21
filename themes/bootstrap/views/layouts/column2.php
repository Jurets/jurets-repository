<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
        <?php
            /*$this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>Yii::t('controls', 'Operations'),
            ));*/
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'operations'),
            ));
            //$this->endWidget();
            
            /*$this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'items'=>array(
                    array('label'=>'LIST HEADER'),
                    array('label'=>'Home', 'icon'=>'home', 'url'=>'#', 'active'=>true),
                    array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
                    array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
                    array('label'=>'ANOTHER LIST HEADER'),
                    array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
                    array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
                    array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),
                ),
            ));*/
            
        ?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>