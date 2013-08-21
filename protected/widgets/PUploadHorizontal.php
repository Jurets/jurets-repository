<?php
/**
 * TbInputHorizontal class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets.input
 */

Yii::import('bootstrap.widgets.input.TbInputHorizontal');

/**
 * Bootstrap horizontal form input widget.
 * @since 0.9.8
 */
class PUploadHorizontal extends TbInputHorizontal
{
    const TYPE_XUPLOAD='echo';
    
    public $multiple;
    public $url;
    public $uploadView;
    public $downloadView;
    public $formView;
    public $autoUpload;
    public $loadStoredData;
    public $storedDataUrl;
    public $options;
    public $downloadTemplate; 
    
    public function run()
    {
        if($this->type==self::TYPE_XUPLOAD) 
        {
          echo CHtml::openTag('div', array('class' => 'control-group ' . $this->getContainerCssClass()));
          $this->xuploadField();
          echo '</div>';
            
        }else 
        {
            parent::run();
        }
    }
    
    protected function xuploadField()
    {
        
        
        echo $this->getLabel();
        echo '<div class="controls">';
        echo $this->getPrepend();
        $field  = $this->attribute;
        $multiple = $this->multiple;
        $htmlOptions = $this->htmlOptions;
        $url = $this->url;
        $uploadModel = $this->model;
        $uploadView = $this->uploadView;
        $downloadView = $this->downloadView; 
        $formView = $this->formView;
        
        $params = array(
                    'url' => $url,
                    'model' => $uploadModel,
                    'attribute' => $field);
                    
        if (!empty($multiple))
               $params['multiple'] = $multiple;
        if (!empty($htmlOptions))
               $params['htmlOptions'] = $htmlOptions;
        if (!empty($uploadView))
               $params['uploadView'] = $uploadView;
        if (!empty($downloadView))
               $params['downloadView'] = $downloadView;
        if (!empty($formView))
               $params['formView'] = $formView;
        if (!empty($multiple)){
               $params['multiple'] = $multiple;
        }
        
        if (!empty($this->autoUpload)){
               $params['autoUpload'] = $this->autoUpload;
        }
        if (!empty($this->options)){
               $params['options'] = $this->options;
        }
        
               
        if (!empty($this->loadStoredData))
               $params['loadStoredData'] = $this->loadStoredData;

        if (!empty($this->storedDataUrl))
               $params['storedDataUrl'] = $this->storedDataUrl;
               
         if (!empty($this->downloadTemplate))
               $params['downloadTemplate'] = $this->downloadTemplate;       

               
         
        $this->widget('XUploadEx',$params); 
         
        echo $this->getAppend();
        
        echo '</div>';
    }
    
    
}
  
?>
