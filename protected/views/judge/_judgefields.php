<?php
    echo CHtml::tag('p', array('class'=>'note'), 'Введите информацию о Вашем статусе судьи:');
    
    echo $form->errorSummary($model); 
    
    echo $form->textFieldRow($model, 'category', array('class'=>'span5','maxlength'=>255)); 
    echo $form->textFieldRow($model, 'level', array('class'=>'span5','maxlength'=>255)); 
    
    //добавление капчи
    echo '<p>Введите код проверки в поле, расположенное ниже</p>';
    $this->widget('CCaptcha');
    //поле для ввода текста капчи
    echo '<br>'.CHtml::activeTextField($model, 'verifyCode');
    echo CHtml::error($model, 'verifyCode');
    //echo CHtml::errorSummary($model).'<br>'; 
    echo '<br>';
?>