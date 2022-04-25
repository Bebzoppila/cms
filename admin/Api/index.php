<?php
    include_once '../Db/DataBase.php';
    include_once '../useful/Files.php';
    $db = new DataBase();
    if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);
        $sql = "DELETE FROM `$data[tableName]` WHERE `$data[tableName]`.`id` = :id";
        $db->sthExecute($sql, ['id' => $data['id']]);
        echo 'True';
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $imgName = $_FILES['img']['name'];
        $fileName = rand(0, 9999999999999);
        $uploadFile = "../../images/slider/".$fileName.".jpg";
        $filePath = "/images/slider/".$fileName.".jpg";
        $sql = "INSERT INTO `$_POST[tableName]` (`title`, `img`) VALUES ('$_POST[title]', '$filePath');";
        $res = $db->sthExecute($sql);
        echo json_encode(['id' => $db->getLastId()]);
        if(move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)){
//            echo 'Загрузилось';
        };
//        echo json_encode($_FILES['img']);
//        Files::loadFile('img', "slider/$imgName");
//        echo json_encode($_SERVER['HTTP_ORIGIN']);
    }
?>