<?php 
namespace App\Models;
use App\Models\Database;
use Exception;
use PDO;

class Subjects{

    private object $pdo;

    public function __construct(){
        $db = new Database;
        $this->pdo = $db->connect();
    }

    public function fetchAll(){
        $sql = "SELECT id,name FROM subjects";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function makeSubject(string $subjectName){
        $sql = "INSERT INTO subjects (name) value (:subjectName)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':subjectName', $subjectName);
        if(!$stmt->execute()){
            throw new Exception("Echec durant la création de la matière.");
        }
    }

    public function deleteSubject($subject_id){
        $sql = "DELETE FROM subjects WHERE id = :subject_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':subject_id', $subject_id);
        if(!$stmt->execute()){
            throw new Exception("Echec durant la suppression de la matière.");
        }
    }

    // public function editClass(int $id,string $column, string $content){
  
    //     $allowedColumns = ['name'];

    //     if (!in_array($column, $allowedColumns)) {
    //         throw new Exception("Colonne non autorisée.");
    //     }
    
    //     $sql = "UPDATE classes SET $column = :content WHERE id = :id ";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->bindParam(':content', $content);

    //     if(!$stmt->execute()){
    //         throw new Exception("Erreur durant le changement de role de l'utilisateur.");
    //     }

      
    // }
}

    
