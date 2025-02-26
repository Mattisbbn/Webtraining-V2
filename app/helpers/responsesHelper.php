<?php
namespace App\Helpers;

class responsesHelper{

    static function actionResponse(bool $isSuccess,string $message){
        header('Content-Type: application/json');
        echo json_encode(["status" => $isSuccess ? "success" : "error", "message" => $message]);
    }
}