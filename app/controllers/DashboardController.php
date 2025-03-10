<?php
namespace App\Controllers;

class DashboardController extends BaseController{

    public function baseView(){
        $this->render("dashboard/dashboard.php");
    }

    public function view($view){

        $usertype = $_SESSION["role_name"];
        
        if($usertype === "Admin"){
            $this->render("dashboard/admin/$view.php");
        }
    }
}