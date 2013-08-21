<li class="span2">
    <input type="hidden" class="vkphotosmall" id="vkphotosmall_<?=$data['pid']?>" name="vkphotosmall[<?=$data['pid']?>]" value="<?=$data['src_small']?>">
    <input type="hidden" class="vkphotobig" id="vkphotobig_<?=$data['pid']?>" name="vkphotobig[<?=$data['pid']?>]" value="<?=$data['src_big']?>">
    <input type="checkbox" id="vkphotolist_<?=$data['pid']?>" name="vkphotolist[<?=$data['pid']?>]" title="Пометить фото для добавления" style="float: right;">
    <!--<a href="<?/*=$data['add_ref']*/?>" class="thumbnail" rel="tooltip" data-title="Tooltip">-->
    <a href="#" class="thumbnail" rel="tooltip" data-title="Tooltip" style="height: 85px;">
        <img src="<?=$data[src_small]?>" alt="">
    </a>
</li>