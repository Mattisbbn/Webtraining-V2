<?php
namespace App\Controllers;
use App\Helpers\SecurityHelper;


class LoginController extends BaseController{

    public function view(){
        $this->render("login/login.php");
    }

    public function handleForm($isAdminForm = false){
        if(!$isAdminForm){
            $requiredFields = ['CSRF', 'email', 'password','userType'];
        }else{
            $requiredFields = ['CSRF', 'email', 'password'];
        }
       

        if(!SecurityHelper::checkPost($requiredFields)){
            return false;
        }
    }


}