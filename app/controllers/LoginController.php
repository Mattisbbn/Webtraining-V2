<?php
namespace App\Controllers;
use App\Helpers\SecurityHelper;
use App\Helpers\responsesHelper;
use App\Models\Users;
use App\Models\AuthTokens;
use Exception;

class LoginController extends BaseController{

    public function view(){
        $this->render("login/login.php");
    }

    public function handleForm(){

        try{
            SecurityHelper::checkPost(['CSRF', 'email', 'password']);
            SecurityHelper::checkCSRF($_POST["CSRF"]);
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
                    
                    responsesHelper::actionResponse(true,"Connecté");
                }else{
                    throw new Exception("Mot de passe invalide.");
                } 
            }else{
                throw new Exception("Il n'y a pas d'utilisateur avec cette email.");
            }
                
            
        }catch(Exception $e){
            responsesHelper::actionResponse(false,$e->getMessage());
        }
        
       }

}




                    
            
                    
                    
               

                    
                