<?php
namespace App\models;
use App\Models\Database;
use Exception;
use PDO;

class Schedules { 
    private object $pdo;

    public function __construct(){
        $db = new Database;
        $this->pdo = $db->connect();
    }

    public function fetchScheduleByClass(int $class_id):array{
        $sql = 
        "SELECT 
        subjects.name as subject_name,
        classes.name as class_name,
        users.username as teacher_name,
        schedule.start_date,
        schedule.end_date 
        FROM schedule 
        LEFT JOIN subjects ON subjects.id = schedule.subject_id
        LEFT JOIN classes ON classes.id = schedule.class_id
        LEFT JOIN users ON users.id = schedule.teacher_id
        WHERE schedule.class_id = :class_id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;

    }
}