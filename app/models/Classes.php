<?php 
namespace App\Models;
use App\Models\Database;
use Exception;
use PDO;

class Classes{

    private object $pdo;

    public function __construct(){
        $db = new Database;
        $this->pdo = $db->connect();
    }

    public function fetchClasses(){
        $sql = "SELECT id,name FROM classes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function makeClass(string $className){
        $sql = "INSERT INTO classes (name) value (:className)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':className', $className);
        if(!$stmt->execute()){
            throw new Exception("Echec durant la création de la classe.");
        }
    }

    public function deleteClass($class_id){
        $sql = "DELETE FROM classes WHERE id = :class_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':class_id', $class_id);
        if(!$stmt->execute()){
            throw new Exception("Echec durant la suppression de la classe.");
        }
    }

    public function editClass(int $id,string $column, string $content){
  
        $allowedColumns = ['name'];

        if (!in_array($column, $allowedColumns)) {
            throw new Exception("Colonne non autorisée.");
        }
    
        $sql = "UPDATE classes SET $column = :content WHERE id = :id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':content', $content);

        if(!$stmt->execute()){
            throw new Exception("Erreur durant le changement de role de l'utilisateur.");
        }

      
    }
}

    
