<?php
namespace App;

use Controller\MainController;

class Route {
    static $get = [];
    static $post = [];

    static function set($method, $url, $action, $permission = null){
        $page = (object)["url" => $url, "action" => $action, "permission" => strtolower($permission)];
        array_push(self::${strtolower($method)}, $page);
    }

    static function takeURL(){
        $url = isset($_GET['url']) ? rtrim($_GET['url']) : "";
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return "/$url";
    }

    static function redirect(){
        $currentURL = self::takeURL();
        foreach(self::${strtolower($_SERVER['REQUEST_METHOD'])} as $page){
            if($page->url === $currentURL){
                $page->permission && call_user_func("is_{$page->permission}");
                self::execute($page);
                exit;
            }
        }
        MainController::notFound();
    }

    static function execute($page){
        $split = explode("@", $page->action);
        $conName = "Controller\\{$split[0]}";
        $controller = new $conName();
        $controller->{$split[1]}();
    }
}