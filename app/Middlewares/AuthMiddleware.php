<?php
namespace App\Middlewares;
use Exception;

use App\Models\AuthTokens;

class authMiddleware {
    static function isValidToken(){
        if(isset($_SESSION["auth_token"])){
            $auth_token = $_SESSION["auth_token"];
            $authModel = new AuthTokens;
            if($authModel->checkAuthToken($auth_token)){
                return true;
            
            }else{
                return false;

            }

        }else{
            return false;
        }
    }
}