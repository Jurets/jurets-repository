<?php
class SportsmenFilter extends CFilter
{
    // код, выполняемый до выполнения действия
    protected function preFilter($filterChain)
    {
        //проверка на макс. кол-во участников
        $success = Competition::checkForSportsmenLimit();
        //$spcount = Sportsmen::getSportsmenCount();
        //$maxspcount = Competition::getSpMaxLimitCount();
        //$success = ($spcount < $maxspcount);
        if (!$success)
            throw new CHttpException(410, 'Запрещено добавлять новых участников! На данный момент действует ограничение по количеству спортсменов: '.$maxspcount.
                '. Чтобы получить разрешение на добавление спортсмена - свяжитесь с организаторами соревнований');

        return $success; // false — для случая, когда действие не должно быть выполнено
    }

    // код, выполняемый после выполнения действия
    protected function postFilter($filterChain)
    {
        //$filterChain->run();
    }
}    
    
  
?>
