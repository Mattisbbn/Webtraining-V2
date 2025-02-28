<?php
namespace App\Helpers;

use Exception;

class SecurityHelper{

    static function checkCSRF(string $token): bool{
        if($token === $_SESSION["CSRF"]){
            return true;
        }
        return false;
    }

    static function checkPost(array $requiredFields): void{
        foreach ($requiredFields as $field) {
       
            if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
                Throw new Exception("Le champ $field est requis !");
            }
        }
    }

    static function hashPassword(string $password){
        $saltedPassword = $password . SALTKEY; 
        $hashedPassword = password_hash($saltedPassword,PASSWORD_BCRYPT);

        return $hashedPassword;
    }

}