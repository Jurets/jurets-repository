<?php
//класс для отправки почты
class MailSender// extends CModel 
{
  //функция отсылки писем (в зависимости от режима)
    public static function send($sendTo = array(), 
                                $template = array('subject'=>'new mail', 'body'=>'It\'s test e-mail'), 
                                $values = array('{hostname}'=>'http://test-host')) 
    {
        $paramsEmail = Yii::app()->params['emailsender'];
        $body = $template['body'];
        $body = str_replace(array_keys($values), array_values($values), $body);
        
        if ($paramsEmail['method'] == 'SMTP') 
        {   
            $subject = '=?UTF-8?B?'.base64_encode($template['subject']).'?=';
            $headers =
                "From: ".$paramsEmail['from']."\r\n".
                "Reply-To: ".$paramsEmail['from']."\r\n".
                "MIME-Version: 1.0"."\r\n".
                "Content-type: text/plain; charset=UTF-8"."\r\n".
                "X-Mailer: PHP/" . phpversion();
            $object = @mail($sendTo[0], $subject, $body, $headers);
        }
        else if ($paramsEmail['method'] == 'PEAR')
            $object = Yii::app()->mailer->send(
                $paramsEmail['from'], //Yii::app()->params['fromEmail'],
                $sendTo,
                $template['subject'],
                $body
            );
        return $object;
    }
}
?>
