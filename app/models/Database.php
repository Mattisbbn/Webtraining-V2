<?php
namespace App\Models;
use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private string $host;
    private string $dbname;
    private string $username;
    private string $password = "CIQM4cO3puI8OeiJ";

    public function __construct(){
        $dotenv = Dotenv::createImmutable("../");
        $dotenv->load();
        $this->host = $_ENV["DB_HOST"];
        $this->dbname = $_ENV["DB_NAME"];
        $this->username = $_ENV["DB_USER"];
        $this->password = $_ENV["DB_PASS"];
    }
    
    public function connect(){
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les erreurs sous forme d'exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut
                PDO::ATTR_EMULATE_PREPARES => false, // Désactive l'émulation des requêtes préparées
            ]);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }

            return $pdo;
    }


}