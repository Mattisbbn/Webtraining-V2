<?php
namespace App\Controllers;

class DashBoardController extends BaseController{

    public function view($usertype){
        if($usertype === "admin"){
            $this->render("dashboard/admin/login.php");
        }
    }

}