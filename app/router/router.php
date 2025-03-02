<?php
$router = new AltoRouter();

use App\Controllers\AdminDashboardController;
use App\Controllers\DashBoardController;
use App\Controllers\LoginController;
use App\Controllers\AdminLoginController;
new DashBoardController;

$router->map("GET","/",function(){
    echo("test");
});

// Login
$router->map("GET","/login",function(){
    $controller = new LoginController();
    $controller->view();
});

$router->map("POST", "/login", function() {
  
    $controller = new LoginController();
    $controller->handleForm(false);  // Traiter la soumission du formulaire
});

$router->map("GET", "/admin", function() {
    $controller = new AdminLoginController();
    $controller->view();
});


$router->map("POST", "/admin/login", function() {
    
    $controller = new AdminLoginController();
    $controller->handleLogin();
});


// Dashboard

$router->map("GET","/dashboard",function(){
    $controller = new DashBoardController();
    $controller->baseView();
});

$router->map("POST","/dashboard/view/[a:view]",function($view){
    $controller = new DashBoardController();
    $controller->view($view);
});



$router->map("POST", "/admin/[a:action]", function($action = null) {
    new AdminDashboardController($action);
});

$router->map("POST", "/admin/[a:action]", function($action = null) {
    new AdminDashboardController($action);
});


$router->map("POST", "/logout", function() {
    session_destroy();
});




$match = $router->match();

if ($match) {
    
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "Route non trouvée";
}
?>
