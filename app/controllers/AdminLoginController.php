<?php
namespace App\Controllers;
use App\Helpers\SecurityHelper;
use App\Models\Users;
use App\Models\AuthTokens;
use Exception;

class AdminLoginController extends BaseController{


    public function view(){
        $this->render("dashboard/admin/login.php");
    }

    public function handleLogin(){
        if(SecurityHelper::checkPost(["CSRF","email","password"])){
            if(SecurityHelper::checkCSRF($_POST["CSRF"])){

                try{
                    $userModel = new Users;
                    $email = $_POST["email"];
                    $rawPassword = $_POST["password"];
                    if($userModel->checkUserByEmail($email)){
                        $userPwd = $userModel->getUserPassword($email);
                        if(password_verify($rawPassword . SALTKEY,$userPwd)){
                            $userId = $userModel->getIdByEmail($email);
                            $AuthTokensModel = new AuthTokens;
                            $token = $AuthTokensModel->makeAuthToken($userId);
                            $_SESSION["auth_token"] = $token;
                            
                        }else{
                            throw new Exception("Mot de passe invalide.");
                        } 
                    }else{
                        throw new Exception("Il n'y a pas d'utilisateur avec cette email.");
                    }

                    }catch(Exception $e){
                        $message = $e->getMessage();

                        echo json_encode([
                            "error" => $message,
                        ]);
                    }
                
               

            }

        }
    }



}