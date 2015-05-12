<?php
class CompetitionFilter extends CFilter
{
    // код, выполняемый до выполнения действия
    protected function preFilter($filterChain)
    {  
        //проверка на доступность ввода заявок
        $isfilling = Yii::app()->isExtendRole || Competition::getCompetitionParam('isfiling');
        if (!$isfilling) {
            $errorcode = 410;
            if ($filterChain->controller->id == 'sportsmen') {
                if ($filterChain->action->id == 'create')
                    $errorcode = 410;
                else if ($filterChain->action->id == 'update')
                    $errorcode = 409;
            } 
            throw new CHttpException($errorcode, 'Запрещен ввод информации! На данный момент регистрация участников, а также редактирование информации запрещены. '.
                'При необходимости свяжитесь с организаторами соревнований');
        }
        return $isfilling; // false — для случая, когда действие не должно быть выполнено
    }
 
    // код, выполняемый после выполнения действия
    protected function postFilter($filterChain)
    {
        //$filterChain->run();
    }
}    
    
  
?>
