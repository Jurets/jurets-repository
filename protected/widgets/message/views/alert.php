<?php foreach($messages as $message) { ?>
    <div role="alert" class="alert alert-<?=$message->category?>" style="margin-left: 10px; margin-right: 20px; text-align: center;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?=CHtml::decode($message->text)?>
    </div>
<?php }?>