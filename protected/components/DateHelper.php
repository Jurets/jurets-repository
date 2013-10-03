<?php
/**
 * Функция для перевода даты на русский язык
 *
 * @param number дата в unix формате
 * @param string формат выводимой даты
 * @param number сдвиг времени (часов, относительно времени на сервере)
 * 
 * %MONTH% — русское название месяца (родительный падеж)
 * %DAYWEEK% — русское название дня недели
 *
 * @example 
 * echo dateToRus( time(), '%DAYWEEK%, j %MONTH% Y, G:i' );
 * 
 * суббота, 10 декабря 2010, 12:03
 */
class DateHelper 
{
    public static function dateToRus($d, $format = 'j %MONTH% Y', $offset = 0)
    {
        $d = strtotime($d);
        $months = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля',
                        'августа', 'сентября', 'октября', 'ноября', 'декабря');
        $days = array('понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье');
        $d += 3600 * $offset;
        $format = preg_replace(array(
            '/%MONTH%/i',
            '/%DAYWEEK%/i'
        ), array(
            $months[date("m", $d) - 1],
            $days[date("N", $d) - 1]
        ), $format);
        return date($format, $d);
    } 

    public static function dateToUkr($d, $format = 'j %MONTH% Y', $offset = 0)
    {
        $d = strtotime($d);
        $months = array('січня', 'лютого', 'березня', 'квітня', 'травня', 'червня', 'липня',
                        'серпня', 'вересня', 'жовтня', 'листопада', 'грудня');
        $days = array('понеділок', 'вівторок', 'середа', 'четвер', 'п`ятница', 'субота', 'неділя');
        $d += 3600 * $offset;
        $format = preg_replace(array(
            '/%MONTH%/i',
            '/%DAYWEEK%/i'
        ), array(
            $months[date("m", $d) - 1],
            $days[date("N", $d) - 1]
        ), $format);
        return date($format, $d);
    }  
 }     
?>
