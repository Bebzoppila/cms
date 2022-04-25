<?php
include_once 'controllers/AbstractController.php';
include_once 'controllers/MainController.php';
class Router
{
    public static function index($patternUrl, $controllerFunc){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($uri, '/'));
        if($uri === $patternUrl){
            $params = ['get' => $_GET, 'post' => $_POST, 'files' => $_FILES];
            call_user_func("$controllerFunc[class]::$controllerFunc[method]", $params);
        }
    }

    public static function GET($patternUrl, $controllerFunc){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            self::index($patternUrl, $controllerFunc);
        }
    }

    public static function POST($patternUrl, $controllerFunc){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            self::index($patternUrl, $controllerFunc);
        }
    }
}