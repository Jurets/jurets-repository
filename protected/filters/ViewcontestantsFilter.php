<?php
// проверка на доступность просмотра списка участников
// see Yii::app()->params['viewContestants'] in params-local.php file
//
class ViewcontestantsFilter extends CFilter
{
    // код, выполняемый до выполнения действия
    protected function preFilter($filterChain)
    {  
        $isView = Yii::app()->IsViewContestants;
        if (!$isView) {
            throw new CHttpException(401, 'Запрещен просмотр информации для неподтвержденных пользователей!' .
                'При необходимости свяжитесь с организаторами соревнований');
        }
        return $isView; // false — для случая, когда действие не должно быть выполнено
    }
 
    // код, выполняемый после выполнения действия
    protected function postFilter($filterChain)
    {
        //$filterChain->run();
    }
}    
    
  
?>
