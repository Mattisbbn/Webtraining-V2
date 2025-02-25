<?php
namespace App\Controllers;

class DashBoardController extends BaseController{

    public function baseView(){
        $this->render("dashboard/dashboard.php");
    }

    public function view($view){
        $usertype = "admin";
        if($usertype === "admin"){
            $this->render("dashboard/admin/$view.php");
        }
    }
}