<?php
namespace App\Models;
use App\Models\Database;

class AuthTokens{

    private object $pdo;

    public function __construct(){
        $db = new Database;
        $this->pdo = $db->connect();
    }
    
    public function makeAuthToken($userId){
        $token = bin2hex(random_bytes(64));
        
        $currentDate = date('Y-m-d H:i:s');
        $expDate = date('Y-m-d H:i:s',strtotime($currentDate . ' +7 days'));
        $sql = "INSERT INTO auth_tokens (token,user_id,expiration_date,created_at) VALUES (:token,:user_id,:expiration_date,:created_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':expiration_date', $expDate);
        $stmt->bindParam(':created_at', $currentDate);
     
        $stmt->execute();
        return $token;
    }

}