<div id="tosser-area">
    <div id="tosser-grid">
    <?php
        //DebugBreak();
        /*foreach ($tosserGrid['levels'] as $levelnum => $level) {
            echo '<div class="boxlevel bl'.$levelnum.'">';
            foreach ($level as $figthnum => $figth) {
                echo '<div class="boxfigth level'.$levelnum.'" id="'.$figthnum.'">';
                echo '<div class="bluenumber">'.$figth[0].'</div>';
                echo '<div class="rednumber">'.$figth[1].'</div>';
                echo '</div>';
            }
            echo '</div>';
        }*/
        //DebugBreak();
        $rawData = $sportsmens->rawData;
      //ЦИКЛ по уровням  
        for ($levelnum = $levelcount; $levelnum > 0; $levelnum--) {
            echo '<div class="boxlevel bl'.$levelnum.'">';
          //ЦИКЛ по боям  
            foreach ($tosserManager['levels'][$levelnum] as $figthnum => $figth) {
                $blueNum = $figth[0];
                $redNum = $figth[1];             
                //DebugBreak();
                $blueName = '';
                $redName = '';
                $blueCommand = '';
                $redCommand = '';
                foreach($rawData as $index => $raw) {
                    //$rawStr = $raw['FullName'].'-'.$raw['Commandname'];
                    if ($raw['TossNum'] == $blueNum) {
                        //$blueName = ' '.$rawStr;
                        $blueName = $raw['FullName'];
                        $blueCommand = $raw['Commandname'];
                        unset($rawData[$index]);
                    } else if ($raw['TossNum'] == $redNum) {
                        //$redName  = ' '.$rawStr;
                        $redName = $raw['FullName'];
                        $redCommand = $raw['Commandname'];
                        unset($rawData[$index]);
                    }
                    if (!empty($blueName) && !empty($redName))
                        break;
                }
                /*echo '<div class="boxfigth level'.$levelnum.'" id="'.$figthnum.'">';
                echo '<div class="bluenumber">'.$blueNum.$blueName.'</div>';
                echo '<div class="rednumber">'.$redNum.$redName.'</div>';
                echo '</div>';*/
                
                $this->renderPartial('_figth', array(
                    'levelnum'=>$levelnum,
                    'figthnum'=>$figthnum,
                    'blueNum'=>$blueNum,
                    'redNum'=>$redNum,
                    'blueName'=>$blueName,
                    'redName'=>$redName,
                    'blueCommand'=>$blueCommand,
                    'redCommand'=>$redCommand,
                ));
            }
            echo '</div>';
        }
    ?>
        <div class="boxlevel bl0">
            <div class="boxfigth level0" id="0">
            </div>
        </div>
    </div>
    
    <div style="overflow: hidden;"></div>
</div>
