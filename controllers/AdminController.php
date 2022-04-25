<?php
include_once 'controllers/AbstractController.php';

class AdminController
{
    public static function index(){
        echo 123132;
        require_once 'admin/index.php';
    }

    public static function create(){
        echo 123;
        require_once 'admin/createField.php';
    }
    public static function add(){
        echo 123;
        require_once 'admin/addData.php';
    }
}