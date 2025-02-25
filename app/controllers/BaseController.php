<?php
namespace App\Controllers;
use App\Middlewares\authMiddleware;
class BaseController{

    public function __construct(){
       if(!authMiddleware::isValidToken() && $_SERVER["REQUEST_URI"] !== "/login" && $_SERVER["REQUEST_URI"] !== "/admin" && $_SERVER["REQUEST_URI"] !== "/admin/login"){
        header("Location: /login");
        exit;
       }
    }

    protected function render($view){
        require_once VIEW_DIR . "partials/head.html";
        require_once VIEW_DIR . "/" . $view;
        require_once VIEW_DIR . "partials/footer.html";
    }
}