<?php
namespace App\Controllers;

class BaseController{

    protected function render($view){
        require_once VIEW_DIR . "partials/head.html";
        require_once VIEW_DIR . "/" . $view;
        require_once VIEW_DIR . "partials/footer.html";
    }
}