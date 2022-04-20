<?php
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $segments = explode('/', trim($uri, '/'));

    switch ($segments[0]){
        case 'admin':{
            $allUrls = ['create-field' => 'createField', 'add-data' => 'addData'];
            $filename = $allUrls[$segments[1]] ? : 'index';
            include_once "admin/$filename.php";
            break;
        }
        case '':{
            include_once 'frontend/index.php';
            break;
        }

    }

?>