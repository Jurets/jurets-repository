<?php

//базовый класс для справочников
class CatalogTable extends CActiveRecord
{
    public static function getList() {
        return self::model()->findAll();
    }
    
}
?>
