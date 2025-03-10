<?php
namespace App\Models;
use App\Models\Database;
use Exception;
use PDO;

class Users{

    private object $pdo;

    public function __construct(){
        $db = new Database;
        $this->pdo = $db->connect();
    }


    public function checkUserByEmail($email):bool{
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if($stmt->fetch()){
            return true;
        }else{
            return false;
        }
    }

    

    public function MakeUser(string $username,string $email,string $hashedPassword,int $classId,int $roleId){
        if($this->checkUserByEmail($email)){
            throw new Exception("Un utilisateur existe déja avec cette email.");
        }

        $currentDate = date('Y-m-d H:i:s');
        $sql = "INSERT INTO users (username,email,password,class_id,role_id,updated_at,created_at) VALUES (:username,:email,:password,:classId,:roleId,:updated_at,:created_at)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':classId', $classId);
        $stmt->bindParam(':roleId', $roleId);
        $stmt->bindParam(':created_at', $currentDate);
        $stmt->bindParam(':updated_at', $currentDate);
        if(!$stmt->execute()){
            throw new Exception("Echec durant la création de l'utilisateur.");
        }
    }

    public function fetchUsers(){
        $sql = "SELECT id,username,email,class_id,role_id,updated_at,created_at FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }


    public function getUserPassword($email){
        $sql = "SELECT password FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $results = $stmt->fetchColumn();
        return $results;
    }

    public function getIdByEmail($email){
        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $results = $stmt->fetchColumn();
        return $results;
    }




    public function deleteUser(int $userId){
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $userId);

        if(!$stmt->execute()){
            throw new Exception("Erreur durant la suppression de l'utilisateur.");
        }

        if($stmt->rowCount() === 0) {
            throw new Exception("Aucun utilisateur trouvé avec l'ID {$userId}.");
        }
    }

    public function changeClass(int $userId, int $classId){
        $sql = "UPDATE users SET class_id = :class_id WHERE id = :user_id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':class_id', $classId);

        if(!$stmt->execute()){
            throw new Exception("Erreur durant le changement de classe de l'utilisateur.");
        }
    }

    public function changeRole(int $userId, int $roleId){
        $sql = "UPDATE users SET role_id = :role_id WHERE id = :user_id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':role_id', $roleId);

        if(!$stmt->execute()){
            throw new Exception("Erreur durant le changement de role de l'utilisateur.");
        }

        if($stmt->rowCount() === 0) {
            throw new Exception("Echec du changement de role.");
        }
    }

    
    public function editUser($content,$userId,$column){
        $allowedColumns = ['username', 'email'];

        if (!in_array($column, $allowedColumns)) {
            throw new Exception("Colonne non autorisée.");
        }
        $sql = "UPDATE users SET $column = :content WHERE id = :user_id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':content', $content);

        if(!$stmt->execute()){
            throw new Exception("Echec de la modification de l'utilisateur.");
        }

        if($stmt->rowCount() === 0) {
            throw new Exception("Aucune colonne affectée.");
        }
    }



    public function fetchTeachers(){
        $sql = "SELECT id,username,email,class_id,role_id,updated_at,created_at FROM users where role_id = 4";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

}


