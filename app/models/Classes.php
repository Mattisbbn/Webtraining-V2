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
}