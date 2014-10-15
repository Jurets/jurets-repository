<?php
/**
*  класс для отправки почтового сообщения
*  использует расширение SwiftMailer
*/
class EmailHelper {

    public static function send($emails, $subject, $view, $data, $file = '')
    {
        ////////// ЗАГЛУШКА для предотвращения отсылки емейла -- <
        //        if (is_file(Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'noemailsending')) { //наличие файла - признак того, чтобы емейл не отсылать
        //ТЕСТОВЫЙ вывод во вьюшку
        //$text = $message->body;  //НЕ РАБОТАЕТ!

        //if Yii::app()->controller doesn't exist create a dummy  controller to render the view (needed in the console app)
        // renderPartial won't work with CConsoleApplication, so use renderInternal - this requires that we use an actual path to the  view rather than the usual alias 
        //            $viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath . '.' . $view).'.php';
        //            $controller = (isset(Yii::app()->controller)) ? Yii::app()->controller : new CController('YiiMail');
        //            $text = $controller->renderInternal($viewPath, $data, true);    
        //$text = $this->renderInternal($viewPath, $data, true);    

        //запись в лог (вместо отсылки по почте)
        //$text = "Отсылка сообщения на ". $email .", тема: " . $subject . "\n\rТекст:\n\r" . str_repeat('-', 50) . "\n\r" . $text . "\n\r" . str_repeat('-', 50) . "\n\r";
        //            Yii::log($text, CLogger::LEVEL_INFO, 'testmail');  
        //            return false;
        //        }
        ////////// >-- 
        //DebugBreak();
        if(empty($emails)) {
            return FALSE;
        }
        $message = new YiiMailMessage;
        $message->subject = $subject;
        $message->view = $view;
        $message->setBody($data, 'text/html');
        $message->setTo($emails);
        //$message->setFrom(array(Yii::app()->params['adminEmail'] => 'Fnetwork.ru'));
        Yii::log(Yii::app()->params['adminEmail'], 'trace', 'mail');
        //var_dump($emails);
        //var_dump(Yii::app()->params['adminEmail']);
        //Yii::app()->end();
        $message->from = ($from = Yii::app()->params['adminEmail']) ? $from : 'noreply@jwms.pro';
        //Yii::log($message->from, 'trace', 'mail');
        if( !empty($file) ) {
            $message->attach(Swift_Attachment::fromPath($_SERVER['DOCUMENT_ROOT'].$file));
        }
        return Yii::app()->mail->send($message);

    }
}
?>