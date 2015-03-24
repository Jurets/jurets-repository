<?php
    echo CHtml::tag('p', array('class'=>'note'), 'Введите информацию о Вашем статусе судьи:');
    
    echo $form->errorSummary($model); 
    
    echo $form->textFieldRow($model, 'category', array('class'=>'span5','maxlength'=>255)); 
    echo $form->textFieldRow($model, 'level', array('class'=>'span5','maxlength'=>255)); 
?>