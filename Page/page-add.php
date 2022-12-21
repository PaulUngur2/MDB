<?php

// Connecting to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

if(isset($_POST['mangaid'])){

    $userid = $_COOKIE['userid'];
    $mangaid = (int)$_POST['titles'];
    $stmt = $mysqli->prepare("INSERT INTO userslist (users, titles) VALUES ($userid, $mangaid)");
    $stmt->execute();
    $stmt->close();
}
$mysqli->close();