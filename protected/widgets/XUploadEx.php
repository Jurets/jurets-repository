<?php
  Yii::import('xupload.XUpload');
/**
 * XUpload extension for Yii.
 *
 * jQuery file upload extension for Yii, allows your users to easily upload files to your server using jquery
 * Its a wrapper of  http://blueimp.github.com/jQuery-File-Upload/
 *
 * @author AsgarothBelem <asgaroth.belem@gmail.com>
 * @link http://blueimp.github.com/jQuery-File-Upload/
 * @link https://github.com/Asgaroth/xupload
 * @version 0.2
 *
 */
class XUploadEx extends XUpload
{
    public $loadStoredData=false;
    public $storedDataUrl='';
    public $fileUpload;
    static private $_instanceNr;
    public function __construct($owner=null)
    {
        parent::__construct($owner);
        if (empty(self::$_instanceNr))
        {
            self::$_instanceNr=1;
        }else
        {
            self::$_instanceNr++;
        }
    }
    public function init()
    {
        parent::init();
        if (empty($this->options['filesUploads']))
        {
            $this->fileUpload='files_'.self::$_instanceNr;
            $this->options['filesContainer'] =  '#'.$this->fileUpload;
        }
        if (!empty($this->downloadTemplate))
        {
            $this->options['downloadTemplateId'] = $this->downloadTemplate;
        }
        
    }
    public function run() 
    {
        parent::run();

        if ($this->loadStoredData)
        {
           $cs = Yii::app()->getClientScript();
           $cs->registerScript('#show-upload-data-'.self::$_instanceNr,
                 '$(document).ready(function() 
                 {
                    var node=  jQuery("#'.$this->htmlOptions['id'].'");
                    node.fileupload("send",{files:{},url:"'.$this->storedDataUrl.'"});  
        })'
          );
        }
    }
}
?>
