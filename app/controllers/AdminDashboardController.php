<?php

namespace App\Controllers;

use App\Helpers\SecurityHelper;
use Exception;
use App\Models\Users;
use App\Helpers\responsesHelper;
use App\Middlewares\authMiddleware;
use App\Models\Classes;
use App\models\Schedules;
use App\Models\Subjects;

class AdminDashboardController{
    public function __construct($action){
        try{
            authMiddleware::checkUserRole("Admin");
            SecurityHelper::checkCSRF($_POST["CSRF"]);
                if (authMiddleware::isValidToken()) {
                   
                    switch ($action) {
                        case 'makeUser':
                            $this->makeUser();
                            break;
                        case 'deleteUser':
                            $this->deleteUser();
                            break;
                        case 'changeUserClass':
                            $this->changeUserClass();
                            break;
                        case 'changeUserRole':
                            $this->changeUserRole();
                            break;
                        case 'editUser':
                            $this->editUser();
                            break;
                        case 'makeClass':
                            $this->makeClass();
                            break;
                        case 'deleteClass':
                            $this->deleteClass();
                            break;
                        case 'editClass':
                            $this->editClass();
                            break;
                        case 'makeSubject':
                            $this->makeSubject();
                            break;
                        case 'deleteSubject':
                            $this->deleteSubject();
                            break;
                        case 'editSubject':
                            $this->editSubject();
                            break;
                        case 'fetchSchedule':
                            $this->fetchSchedule();
                            break;
                        default:
    
                            break;
                    }
                }
         
        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        } 
    }

    public function makeUser(){

        try {
            SecurityHelper::checkPost(["username","email","password","class_id","role_id"]);
            $this->checkUsername();
            $this->checkEmail();
            $this->checkPassword();
            $username = $_POST["username"];
            $email = $_POST["email"];
            $hashedPassword = SecurityHelper::hashPassword($_POST["password"]);
            $classId = $_POST["class_id"];
            $roleId = $_POST["role_id"];
            $userModel = new Users;
            $userModel->makeUser($username, $email, $hashedPassword, $classId, $roleId);

            responsesHelper::actionResponse(true, "Compte créé avec succès.");
        } catch (Exception $e) {
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function deleteUser(){
        try{
            if(!isset($_POST["user_id"]) || empty($_POST["user_id"])){
                throw new Exception("Erreur, l'uid n'a pas été reçu.");
            }
            $userId = $_POST["user_id"];
            $userModel = new Users;
            $userModel->deleteUser($userId);
            responsesHelper::actionResponse(true, "Compte supprimé avec succès.");
        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function changeUserClass(){
        try{
            if(!isset($_POST["user_id"]) || empty($_POST["user_id"]) || !isset($_POST["class_id"]) || empty($_POST["class_id"]) ){
                throw new Exception("Erreur, l'id de la classe et/ou de l'utilisateur n'as pas été reçu.");
            }

            $userId = $_POST["user_id"];
            $classId = $_POST["class_id"];

            $userModel = new Users;
            $userModel->changeClass($userId,$classId);

            responsesHelper::actionResponse(true,"Changement de classe effectué avec succès.");

        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function changeUserRole(){
        try{
            if(!isset($_POST["user_id"]) || empty($_POST["user_id"]) || !isset($_POST["role_id"]) || empty($_POST["role_id"]) ){
                throw new Exception("Erreur, l'id du role et/ou de l'utilisateur n'as pas été reçu.");
            }

            $userId = $_POST["user_id"];
            $roleId = $_POST["role_id"];

            $userModel = new Users;
            $userModel->changeRole($userId,$roleId);

            responsesHelper::actionResponse(true,"Changement du role effectué avec succès.");

        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    public function editUser(){

        try{
            
            if(!isset($_POST["user_id"]) || empty($_POST["user_id"]) || !isset($_POST["column"]) || empty($_POST["column"]) || !isset($_POST["content"]) || empty($_POST["column"]) ){
                throw new Exception("Erreur, informations manquantes.");
            }

            $userId = $_POST["user_id"];
            $column = htmlspecialchars($_POST["column"]);
            $content = htmlspecialchars($_POST["content"]);
            
            $userModel = new Users;
            $userModel->editUser($content,$userId,$column);

            responsesHelper::actionResponse(true,"Modification effectuée avec succès.");

        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function makeClass(){
        try{
            SecurityHelper::checkPost(["class"]);
            $className = htmlspecialchars($_POST["class"]);
            $classesModel = new Classes;
            $classesModel->makeClass($className);
            responsesHelper::actionResponse(true,"La classe a été créée avec succès.");
        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function deleteClass(){
        try{
            SecurityHelper::checkPost(["class_id"]);
            $classId = htmlspecialchars($_POST["class_id"]);
            $classesModel = new Classes;
            $classesModel->deleteClass($classId);
            responsesHelper::actionResponse(true,"La classe a été supprimée avec succès.");
        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function editClass(){
        try{
            SecurityHelper::checkPost(["id","column","content"]);
            $id = intval(htmlspecialchars($_POST["id"]));
            $column = htmlspecialchars($_POST["column"]);
            $content = htmlspecialchars($_POST["content"]);
            $userModel = new Classes;
            $userModel->editClass($id,$column,$content);

            responsesHelper::actionResponse(true,"Modification effectuée avec succès.");

        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function makeSubject(){
        try{
            SecurityHelper::checkPost(["subject"]);
            $subjectName = htmlspecialchars($_POST["subject"]);
            $subjectModel = new Subjects;
            $subjectModel->makeSubject($subjectName);
            responsesHelper::actionResponse(true,"La matière a été créée avec succès.");
        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function deleteSubject(){
        try{
            SecurityHelper::checkPost(["subject_id"]);
            $subjectId = htmlspecialchars($_POST["subject_id"]);
            $subjectsModel = new Subjects;
            $subjectsModel->deleteSubject($subjectId);
            responsesHelper::actionResponse(true,"La matière a été supprimée avec succès.");
        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function editSubject(){
        try{
            SecurityHelper::checkPost(["id","column","content"]);
            $id = intval(htmlspecialchars($_POST["id"]));
            $column = htmlspecialchars($_POST["column"]);
            $content = htmlspecialchars($_POST["content"]);
            $subjectsModel = new Subjects;
            $subjectsModel->editSubject($id,$column,$content);

            responsesHelper::actionResponse(true,"Modification effectuée avec succès.");

        }catch(Exception $e){
            responsesHelper::actionResponse(false, $e->getMessage());
        }
    }
    private function checkUsername(){
        if (isset($_POST["username"]) && !empty($_POST["username"])) {

            $username = $_POST["username"];
            if (strlen($username) < 5 || strlen($username) > 30) {
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
        } else {
            throw new Exception("Veuillez entrer un nom d'utilisateur.");
        }
    }
    private function checkPassword(){
        if (isset($_POST["password"]) && !empty($_POST["password"])) {
            $password = $_POST["password"];

            if (strlen($password) < 8) {
                throw new Exception("Votre mot de passe doit contenir plus de 8 caractères.");
            }
            if (preg_match('/\s/', $password)) {
                throw new Exception("Le mot de passe ne peut pas contenir d'espaces.");
            }

            if (!preg_match('/[0-9]/', $password)) {
                throw new Exception("Le mot de passe doit contenir au moins un chiffre.");
            }
        } else {
            throw new Exception("Veuillez entrer un mot de passe.");
        }
    }
    private function checkEmail(){
        if (isset($_POST["email"]) && !empty($_POST["email"])) {
            $email = $_POST["email"];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Veuillez entrer une adresse email valide.");
            }
        } else {
            throw new Exception("Veuillez entrer une adresse email.");
        }
    }


    private function fetchSchedule(){
        SecurityHelper::checkPost(["CSRF","class_id"]); 
        $class_id = $_POST["class_id"];
        $scheduleModel = new Schedules;
        $classSchedule = $scheduleModel->fetchScheduleByClass($class_id);

        echo json_encode($classSchedule);
    }
}
