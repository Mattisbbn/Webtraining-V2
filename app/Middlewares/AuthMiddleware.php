<?php
namespace App\Middlewares;

use App\Models\AuthTokens;
use Exception;

class authMiddleware {
    static function isValidToken():bool|Exception{
        if(isset($_SESSION["auth_token"])){
            $auth_token = $_SESSION["auth_token"];
            $authModel = new AuthTokens;

            $user = $authModel->checkAuthToken($auth_token);
            if($user){
                $_SESSION["username"] = $user["username"];
                $_SESSION["role_name"] = $user["role"];
                return true;
            
            }else{
                return false;
            }
        }
        return false;
    }
    static function checkUserRole(string $role):true|Exception{
        if($_SESSION["role_name"] === $role){
            return true;
        }
        throw new Exception("Veuillez vous connecter en tant que $role pour acceder à cette page.");
    }

}