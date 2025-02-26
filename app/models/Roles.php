<?php
namespace App\Models;
use App\Models\Database;
use PDO;

class Roles{

    private object $pdo;

    public function __construct(){
        $db = new Database;
        $this->pdo = $db->connect();
    }

    public function fetchRoles(){
        $sql = "SELECT id,name FROM roles";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

}