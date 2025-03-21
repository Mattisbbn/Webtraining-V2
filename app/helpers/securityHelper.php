<?php
namespace App\Helpers;

use Exception;

class SecurityHelper{

    static function checkCSRF(): void{
        if(!isset($_POST["CSRF"])){
            throw new Exception("Il manque le token CSRF.");
        }

        if($_POST["CSRF"] !== $_SESSION["CSRF"]){
          throw new Exception("Token CSRF invalide.");
        }

    }
    static function checkPost(array $requiredFields): void{
        foreach ($requiredFields as $field) {
       
            if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
                Throw new Exception("Le champ $field est requis !");
            }
        }
    }
    static function hashPassword(string $password):string{
        $saltedPassword = $password . SALTKEY; 
        $hashedPassword = password_hash($saltedPassword,PASSWORD_BCRYPT);

        return $hashedPassword;
    }
}