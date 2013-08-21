<!--<style>
    .toggle {
        display: inline;
    }
    .preview {
        width: 140px;
    }
    .delete {
        width: 140px;
    }
    .table-striped tbody tr td {
        background-color: #F9F9F9;
    }
/*    .photodescription {
        left: -182px;
        position: relative;
        top: 62px;
    }   */ 
    .files .progress {
        width: auto;
    }    
</style>-->

<!-- The file upload form used as target for the file upload widget -->
<?php //echo CHtml::beginForm($this -> url, 'post', $this -> htmlOptions);?>
<div id='<?=$this->htmlOptions['id']?>'>
  <div class="row fileupload-buttonbar">
	<div class="span7" title="Выбрать фото для загрузки" style="width: auto;">
		<!-- The fileinput-button span is used to style the file input field as button -->
		<span class="btn btn-success fileinput-button"> <i class="icon-plus icon-white"></i> <span>Выбрать фото</span>
			<?php
            if ($this -> hasModel()) :
                echo CHtml::activeFileField($this -> model, $this -> attribute, $htmlOptions) . "\n";
            else :
                echo CHtml::fileField($name, $this -> value, $htmlOptions) . "\n";
            endif;
            ?>
		</span>
        <?php if ($this->attribute == 'files') { ?>
                <button class="btn btn-primary start" type="submit" title="Загрузить выбранные фото">
                    <i class="icon-upload icon-white"></i>
                    <span>Загрузить</span>
                </button>
                <button class="btn btn-warning cancel" type="reset" title="Отменить загрузку фото">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Отменить</span>
                </button>
                <button class="btn btn-danger delete" type="button" title="Удалить отмеченные фото">
                    <i class="icon-trash icon-white"></i>
                    <span>Удалить</span>
                </button>
                <input type="checkbox" class="toggle" title="Отметить все для удаления">
        <?php } ?>


	</div>
	<div class="span4" style="float: right;">
		<!-- The global progress bar -->
		<div class="progress progress-success progress-striped active fade">
			<div class="bar" style="width:0%;"></div>
		</div>
	</div>
</div>
<!-- The loading indicator is shown during image processing -->
<div class="fileupload-loading"></div>
<br>
<!-- The table listing the files available for upload/download -->
<table class="table table-striped" role="presentation">
	<!--<col width="140">-->
    <col width="140">
    <col width="340">
    <tbody id='<?=$this->fileUpload?>' class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
</table>
</div>
