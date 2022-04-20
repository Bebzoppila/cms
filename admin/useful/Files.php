<?php

class Files
{
    public static function loadFile($fileName, $uploadFilePath){
        $uploadFile = "images/$uploadFilePath";
        $isLoad = false;
//        print_r(isset($_FILES[$fileName]));
        if(isset($_FILES[$fileName])){
            echo  $uploadFile;
            move_uploaded_file($_FILES[$fileName]['tmp_name'], $uploadFile);
            $isLoad = true;
        }
        return $isLoad;
    }
}