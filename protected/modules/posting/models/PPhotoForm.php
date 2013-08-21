<?php
  class PPhotoForm extends XUploadForm
  {

      
     private  $_thumbnailFileName;
     private  $_fileName;
     private  $_thumbnailFileType;
     private  $_FileType;
     
     
     
     private  $_fullSizeW;
     private  $_fullSizeH;

     private  $_thumbSizeW;
     private  $_thumbSizeH;
     private  $_imgTranspColor= array(255,255,255);
     
     private $_photo_id;
     
     private $_title;
     
     private $_labelPhotoTitle;
     private $_labelPhotosTitle;
     
     
     
     private function _createSecureName($filename)
     {
         return sha1( Yii::app( )->user->id.microtime( ).$filename); 
     }
     public function setPhotoTitle($title)
     {
         
         $this->_labelPhotoTitle = $title;
         
     }

     public function setPhotosTitle($title)
     {
         $this->_labelPhotosTitle = $title;
         
     }
     
      
     public function attributeLabels()
        {
                return array(
                        'file'=>$this->_labelPhotoTitle,
                        'files' =>$this->_labelPhotosTitle
                );
        }
     
     
     public function getPhotoId()
     {
         return $this->_photo_id;
     }
     public  function getTitle()
     {
         return $this->_title;
     }
     private function setTitle($title)
     {
         $this->_title=$title;
         
     }
      public function getType()
      {
            return $this->_FileType;
      }
      public function getFileSize()
      {
         if (is_file($this->_fileName))
         {
               return filesize($this->_fileName);    
         }
         else return null;
      }
       public function getImageName()
       {
            return $this->_fileName;
       }
      
       public function getTType()
       {
            return $this->_thumbnailFileType;
       }
       
        
        
        public function getTFileSize()
        {
            if (is_file($this->_thumbnailFileName))
            {
               return filesize($this->_thumbnailFileName);    
            }
            else return null;
            
        }
        public function getThumbnailFilename()
        {
            return $this->_thumbnailFileName;
        }
        
       
        public function setImageName($imageName)
        {
            return $this->_fileName =$imageName;
            
        }
        
        private function createImage($srcImg,$srcSizeW, $srcSizeH,$dstSizeW, $dstSizeH)
        {
            $scale =  min($dstSizeW/$srcSizeW,$dstSizeH/$srcSizeH);
            $dstImg = imagecreatetruecolor($dstSizeW, $dstSizeH);
            $white = imagecolorallocate($dstImg,$this->_imgTranspColor[0], $this->_imgTranspColor[1], $this->_imgTranspColor[2]);
            
            imagefilledrectangle($dstImg,0,0,$dstSizeW,$dstSizeH,$white);
            $offsetX = floor(($dstSizeW-$srcSizeW*$scale)/2);
            $offsetY= floor(($dstSizeH-$srcSizeH*$scale)/2);
            
            $sampledW = ceil($srcSizeW*$scale);
            $sampledH = ceil($srcSizeH*$scale);
            
            imagecopyresampled($dstImg,$srcImg,$offsetX,$offsetY,0,0,$sampledW, $sampledH,$srcSizeW, $srcSizeH);
            imagecolortransparent($dstImg,$white );
            imagecolordeallocate($dstImg,$white);
            return $dstImg;
            
        }
        public function setImageSize($fullSizeW,$fullSizeH,$thumbSizeW,$thumbSizeH) 
        {
             $this->_fullSizeW = $fullSizeW;
             $this->_fullSizeH = $fullSizeH;

             $this->_thumbSizeW = $thumbSizeW;
             $this->_thumbSizeH = $thumbSizeH;
            
        }
        public function saveAsExt($file,$fileName,$thumbFileName)
        {
            
            list($width, $height,$type) = getimagesize($file->tempName);
            switch ($type)
           {
              case 1: $src = imagecreatefromgif($file->tempName); break;
              case 2: $src = imagecreatefromjpeg($file->tempName);  break;
              case 3: $src = imagecreatefrompng($file->tempName); break;
              default: $src =null;  break;
           }
           if ($src)
           {
               $img= $this->createImage($src,$width,$height,$this->_fullSizeW,$this->_fullSizeH);
               imagepng($img,$fileName);
               imagedestroy($img);

               $img= $this->createImage($src,$width,$height,$this->_thumbSizeW,$this->_thumbSizeH);
               imagepng($img,$thumbFileName);
               imagedestroy($img);
               $this->_thumbnailFileName = $thumbFileName;
               $this->_thumbnailFileType  = 'image/png';
               $this->_fileName  =  $fileName;
               $this->_FileType = 'image/png';
               return true;

               
           }else 
           {
               unlink($file->tempName);
               return false; 
           }
            
            
        }
      
     
     
     public function saveUpload($fileObject,$title,$uploadPath,$publicPath,$metrics)
      {
           
           
          $photo = new Photo; 
           $this->setImageSize($metrics->sizeW,$metrics->sizeH,$metrics->thumbSizeW,$metrics->thumbSizeH);
                
                //Initialize the additional Fields, note that we retrieve the
           $photo->description = $title;
                
                    
                    $path = $uploadPath;
                    $origFilename = $fileObject->getName();  

                    $filename =$path.$this->_createSecureName($origFilename).'.png';
                                
                    $tFilename = $path.$this->_createSecureName('t_'.$origFilename).'.png';
                    $this ->saveAsExt($fileObject,$filename,$tFilename);
                    
                    $photo->pmime_type = $this->_FileType;
                    $photo->pfilesize =  $this->getFileSize();
                    $photo->filename =   $this->_fileName;
                    $photo->orig_name = $origFilename;
                    
                    $photo->tfilesize =  $this->getTFileSize();
                    $photo->tmime_type = $this->_thumbnailFileType;
                    $photo->thumb_filename = $this->_thumbnailFileName;
                    $photo->description = $title;
                    $photo->save();
                    $this->_photo_id = $photo->photo_id;
                    //return $photo->photo_id;
                    return $photo;
  }
  
} 
?>
