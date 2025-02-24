<?php
namespace App\Helpers;

class SecurityHelper{

    static function checkCSRF(string $token): bool{
        if($token === $_SESSION["CSRF"]){
            return true;
        }
        return false;
    }

    static function checkPost(array $requiredFields): bool{
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                echo("Le champ $field est requis !");
                return false;
            }
        }
        return true;
    }

    static function hashPassword(string $password){
        $saltedPassword = $password . SALTKEY; 
        $hashedPassword = password_hash($saltedPassword,PASSWORD_BCRYPT);

        return $hashedPassword;
    }

}