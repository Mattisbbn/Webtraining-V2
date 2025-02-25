<?php
namespace App\Controllers;
use App\Helpers\SecurityHelper;
use Exception;
use App\Models\Users;
class AdminDashboardController {

    public function __construct($action){
        if(SecurityHelper::checkCSRF($_POST["CSRF"])){


            switch ($action) {
                case 'makeUser':
                    $this->makeUser();
                    break;
               
                default:
                   
                    break;
            }



          

        }
    }

    public function makeUser(){
        
        try{
            $this->checkUsername();
            $this->checkEmail();
            $this->checkPassword();
            $username = $_POST["username"];
            $email = $_POST["email"];
            $hashedPassword = SecurityHelper::hashPassword($_POST["password"]);
            $classId = 1;
            $roleId = 1;

            $userModel = new Users;
            $userModel->makeUser($username,$email,$hashedPassword,$classId,$roleId);

        }catch(Exception $e){
            echo($e->getMessage());
        }
    }

    private function checkUsername(){
        if(isset($_POST["username"]) && !empty($_POST["username"])){

            $username = $_POST["username"];
            if(strlen($username) < 5 || strlen($username) > 30){
                throw new Exception("Le nom doit doit contenir entre 5 et 30 caractères.");
            }

            $pattern = '/^[a-zA-Z0-9_-]+$/';
            if (!preg_match($pattern, $username)) {
                if (preg_match('/\s/', $username)) {
                    throw new Exception("Le nom d'utilisateur ne peut pas contenir d'espaces.");
                }
                if (preg_match('/[^\x00-\x7F]/', $username)) { 
                    throw new Exception("Le nom d'utilisateur ne peut pas contenir d'emojis ou de caractères spéciaux.");
                }
                throw new Exception("Le nom d'utilisateur ne peut contenir que des lettres, des chiffres, des underscores (_) et des traits d'union (-).");
            }

        }else{
            throw new Exception("Veuillez entrer un nom d'utilisateur.");
        }
    }

    private function checkPassword(){
        if(isset($_POST["password"]) && !empty($_POST["password"])){
            $password = $_POST["password"];

            if(strlen($password) < 8){
                throw new Exception("Votre mot de passe doit contenir plus de 8 caractères.");
            }
            if (preg_match('/\s/', $password)) {
                throw new Exception("Le mot de passe ne peut pas contenir d'espaces.");
            }

            if (!preg_match('/[0-9]/', $password)) {
                throw new Exception("Le mot de passe doit contenir au moins un chiffre.");
            }
        }else{
            throw new Exception("Veuillez entrer un mot de passe.");
        }
    }

    private function checkEmail(){
        if(isset($_POST["email"]) && !empty($_POST["email"])){
            $email = $_POST["email"];

            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                throw new Exception("Veuillez entrer une adresse email valide.");
            }     
           
        }else{
            throw new Exception("Veuillez entrer une adresse email.");
        }
    }














}

