<?php
    include_once 'admin/Db/DataBase.php';
class ApiController
{
    public static function updateGeneralInfo($params){
        $uploadFile = "images/logo.png";
        $phone = $params['post']['phone'];
        $email = $params['post']['email'];
        $db = new DataBase();
        move_uploaded_file($_FILES['logo']['tmp_name'], $uploadFile);
        $db->sthExecute("UPDATE `general-information`
                SET phone = '$phone',
                email = '$email'
                WHERE `general-information`.id = 1");
    }

    public static function createField($params){
        $postData = $params['post'];
        $sql = "CREATE TABLE `$postData[tableName]`(";
        unset($postData['tableName']);
        $sql .= "`id` INT(11) NOT NULL AUTO_INCREMENT,";
        foreach ($postData as $value){
            if($value[1] == 'IMG'){
                $sql .= "`$value[0]` VARCHAR(255) NOT NULL,";
                continue;
            }
            $sql .= "`$value[0]` $value[1] NOT NULL,";
        }
//
        $sql = $sql . ' PRIMARY KEY (`id`))  ENGINE = InnoDB;';
        $db = new DataBase();
        print_r($sql);
        $db->sthExecute($sql);
    }

    public static function addData($params){
        $postData = $params['post'];
        unset($postData['id']);
        if(count($params['files'])){
            $fileName = rand(0, 9999999999999);
            $filePath = "/images/slider/".$fileName.".jpg";
            $postData['img'] = $filePath;
            $uploadFile = "images/slider/".$fileName.".jpg";
            move_uploaded_file($params['files']['img']['tmp_name'], $uploadFile);
        }

        $tableName = $postData['tableName'];
        unset($postData['tableName']);

        $sql = "INSERT INTO `$tableName`";

        $strKeys = '';
        foreach ($postData as $key => $value){
            $strKeys .= "`$key`,";
        }
        $strKeys = '('.mb_substr($strKeys,  0, -1).')';

        $strValues = '';
        foreach ($postData as $key => $value){
            $strValues .= "'$value',";
        }
        $strValues = '('.mb_substr($strValues,  0, -1).')';
        $sql .= $strKeys . 'VALUES'.$strValues ;
//        print_r($sql);
        $db = new DataBase();
        $res = $db->sthExecute($sql);
        echo json_encode(['id' => $db->getLastId()]);
    }

    public static function update($params){
        $postData = json_decode(file_get_contents('php://input'), true);
        $sql = "UPDATE `$postData[tableName]` SET `$postData[key]` = '$postData[value]' 
                                            WHERE `$postData[tableName]`.`id` = $postData[id]";
        $db = new DataBase();
        $res = $db->sthExecute($sql);
        echo json_encode(['id' => $db->getLastId()]);
    }

//UPDATE `main-slider` SET `title` = 'Судите по результатамwad' WHERE `main-slider`.`id` = 6
}