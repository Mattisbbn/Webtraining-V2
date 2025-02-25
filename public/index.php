<?php
session_start();
if(!isset($_SESSION["CSRF"])){
    $_SESSION["CSRF"] = bin2hex(random_bytes(32));
}
require_once("../config/config.php");
require_once("../vendor/autoload.php");
require_once("../app/router/router.php");
?>