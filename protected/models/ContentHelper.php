<?php
  class ContentHelper extends CComponent
  {
      const STR_LEN = 58;
      static function prepareCommentContent($content,$len=self::STR_LEN)
      {
          if ($len == self::STR_LEN)
          {
              $newContent = html_entity_decode(self::linesWrap(htmlentities($content,null,'UTF-8', false), $len, 0, '<wbr>'), ENT_QUOTES, 'UTF-8');
              return $newContent;
          }else
          {              
              $words= explode(' ',$content);
              $newContentChunks= array();
              
              foreach ($words as $item)
              {
                  if (self::isLink($item)){
                      
                      $newContentChunks[] =self::createLink($item) ;
                  }elseif (mb_strlen($item, 'UTF-8')>$len)
                  {
                      $newContentChunks[] = self::longWrap($item,$len,'<wbr>');
                  }else 
                  {
                      $newContentChunks[] = $item; 
                  }
              }
          return implode(' ',$newContentChunks);
          }
      }
      static function isLink($url)
      {   
          return preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $url);
           
      }
      static function createLink($link)
      {

          $data = parse_url($link);
          if (empty($data['scheme']))
          {
              $pos = strpos($data['path'],"/");
              if($pos>0)
              {
                  $data=substr($data['path'],0,$pos);
                  
              }
              $data='http://'.$data;
              $link='http://'.$link;
          }else 
          {
             $data= $data['scheme']."://".$data['host'];    
          }
          
          
          return "<a href='$link'>$data</a>";
      }
      


    static private function longWrap($data,$len,$break)
    {
        $data = strip_tags($data);
        $strLen = mb_strlen($data, 'UTF-8');
        if ($strLen<=$len)
        {
            return $data;
        }
        $chunks = array();
        $strLen-=$len;
        for($nChunk=0;$nChunk<$strLen;$nChunk+=$len)
        {
            $chunks[]= mb_substr($data,$nChunk,$len, 'UTF-8');
            
        }
        $chunks[]=mb_substr($data,$nChunk,$len, 'UTF-8');
        
        return implode($break,$chunks);
    }
    
    
    public static function cutString($string, $length) {
        if(mb_strlen($string)) {
            $sCutStr = '';
            $aWords = explode(' ',$string);
            foreach($aWords as $word) {
                if(mb_strlen($sCutStr.' '.$word) <= $length) {
                    $sCutStr .= ' '.$word;
                } else {
                    break;
                }
            }
            return $sCutStr;
        } else {
            return $string;
        }
    }
    
    public static function prepareStr($str) {
     return htmlentities(strip_tags($str), ENT_QUOTES, 'UTF-8', false);  
    }
    
    public static function linesWrap($str, $width=70, $lines = 2, $break = PHP_EOL){

//        $str = self::prepareStr($str);
        $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8'); 
        $str = strip_tags($str);
        
        // Return short or empty strings untouched
        if(empty($str) || mb_strlen($str, 'UTF-8') <= $width)
            return $str;
        $br_width  = mb_strlen($break, 'UTF-8');
        $str_width =  mb_strlen($str, 'UTF-8');
        $count_lines = 0;
        $return = '';
        $last_space = false;

        for($i=0, $count=0; $i < $str_width; $i++, $count++) {
            // If we're at a break
            if (mb_substr($str, $i, $br_width, 'UTF-8') == $break) {
                $count = 0;
                $return .= mb_substr($str, $i, $br_width, 'UTF-8');
                $count_lines++;
                $i += $br_width - 1;
                continue;
            }
            // Keep a track of the most recent possible break point
            if(mb_substr($str, $i, 1, 'UTF-8') == ' '){
                $last_space = $i;
            }

            // It's time to wrap
            if ($count > $width) {
                // There are no spaces to break on!  Going to truncate
                if(!$last_space) {
                    $return .= $break;
                    $count = 0;
                } else {
                    // Work out how far back the last space was
                    $drop = $i - $last_space;
                    // Cutting zero chars results in an empty string, so don't do that
                    if($drop > 0) {
                        $return = mb_substr($return, 0, -$drop, 'UTF-8');
                    }
                    // Add a break
                    $return .= $break;
                    // Update pointers
                    $i = $last_space; //+ ($br_width - 1);
                    $last_space = false;
                    $count = 0;
                }
              $count_lines++;
            }
            // Add character from the input string to the output
            if($lines > 0 && $count_lines == $lines) break;
            $return .= mb_substr($str, $i, 1, 'UTF-8');
        }
        
        $return = htmlentities($return, ENT_QUOTES, 'UTF-8', false);
        
        return $return;
    }
    
    public static function cleanupEmptyPghs($str) {
      $res = preg_replace('/(<p>|<div>)(&nbsp;|\r\n|\r|\n|\s)(<\/p>|<\/div>)/', '<p></p>', $str);  
       return $res;
      //return str_replace(array("\n", "\r"), '', $str);  
    }
    
/**
 * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
 * @param  $number Integer Число на основе которого нужно сформировать окончание
 * @param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
 *         например array('яблоко', 'яблока', 'яблок')
 * @return String
 */
 public static function numEnding($number, $endingArray)
 {
     $number = $number % 100;
     if ($number>=11 && $number<=19) {
         $ending=$endingArray[2];
     }
     else {
         $i = $number % 10;
         switch ($i)
         {
             case (1): $ending = $endingArray[0]; break;
             case (2):
             case (3):
             case (4): $ending = $endingArray[1]; break;
             default: $ending=$endingArray[2];
         }
     }
     return $ending;
 }
 
    //get max length for string attribute
    public static function getAttrMaxLength($sourceObject, $attrname) {
        foreach($sourceObject->getValidators($attrname) as $key => $validator) {
            if (array_key_exists('max', $validator))
                    $maxlen = $validator->max;
            }
            if (!isset($maxlen))
                $maxlen = 255;
        return $maxlen;
    }  
    
}  
?>
