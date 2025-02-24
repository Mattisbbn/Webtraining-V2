<?php
namespace App\Models;
use PDO;
use PDOException;

class Database {
    private string $host = "localhost";
    private string $dbname = "webtraining-v2";
    private string $username = "pcdev";
    private string $password = "CIQM4cO3puI8OeiJ";


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