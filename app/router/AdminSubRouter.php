<?php
namespace App\Router;


use AltoRouter;

class AdminSubRouter{
    private AltoRouter $router;

    public function __construct(){
        $this->router = new AltoRouter();
        $this->router->setBasePath("/dashboard");
        $this->defineRoutes();
    }

    private function defineRoutes(){
        $this->router->map("GET","/",function(){
            echo("test");
        });
        $this->dispatch();
    }

    public function dispatch() {
        $match = $this->router->match();
        if ($match) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
            echo "Page introuvable";
        }
    }

}




?>
