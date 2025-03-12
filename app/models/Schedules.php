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
        schedule.end_date,
        schedule.id
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

    public function deleteSchedule(int $schedule_id):void{
        $sql = "DELETE FROM schedule WHERE id = :schedule_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':schedule_id',$schedule_id);
        if(!$stmt->execute()){
            throw new Exception("Echec de la suppression du cours.");
        }
        return;
    }
  
    public function makeEvent(int $subject_id,int $teacher_id,int $class_id,$start_date,$end_date){
        $sql = "INSERT INTO schedule (subject_id,class_id,teacher_id,start_date,end_date) VALUES (:subject_id,:class_id,:teacher_id,:start_date,:end_date)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindparam(':subject_id',$subject_id);
        $stmt->bindparam(':class_id',$class_id);
        $stmt->bindparam(':teacher_id',$teacher_id);
        $stmt->bindparam(':start_date',$start_date);
        $stmt->bindparam(':end_date',$end_date);
        if(!$stmt->execute()){
            throw new Exception("Echec de la création du cours.");
        }
        return;
    }
}