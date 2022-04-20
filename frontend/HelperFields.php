<?php
require_once 'admin/Db/DataBase.php';
class HelperFields
{
    static $generalData;

    public static function getGeneralData($field){
        $db = new DataBase();

        if(isset(self::$generalData)){
            return self::$generalData[$field];
        }
        self::$generalData = $db->queryOne('SELECT * FROM `general-information` WHERE 1');
        return self::$generalData[$field];
    }

    public static function getAllFieldData($fieldName){
        $db = new DataBase();
        print_r($fieldName);
        return $db->queryAll("SELECT * FROM `$fieldName`");
    }
}