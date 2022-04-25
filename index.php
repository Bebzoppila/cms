<?php
    include_once 'Router.php';
    include_once 'controllers/AdminController.php';
    include_once 'controllers/MainController.php';
    include_once 'controllers/ApiController.php';

    Router::GET('/', ['class' => 'MainController', 'method' => 'index']);


    Router::GET('/admin/', ['class' => 'AdminController', 'method' => 'index']);
    Router::GET('/admin/create/', ['class' => 'AdminController', 'method' => 'create']);
    Router::GET('/admin/add-data/', ['class' => 'AdminController', 'method' => 'add']);

    Router::POST('/admin/update-general-info/', ['class' => 'ApiController', 'method' => 'updateGeneralInfo']);
    Router::POST('/admin/create-field/', ['class' => 'ApiController', 'method' => 'createField']);
    Router::POST('/admin/add-data/', ['class' => 'ApiController', 'method' => 'addData']);
    Router::POST('/admin/update-data/', ['class' => 'ApiController', 'method' => 'update']);
?>