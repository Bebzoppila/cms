<?php
include_once 'controllers/AbstractController.php';
class MainController
{
    public static function index(){
//        print_r($getParams);
        require_once 'frontend/index.php';
    }
}