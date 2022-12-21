<?php

// Connecting to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

// If the user isn't logged it, redirect to login page
if(!isset($_COOKIE["login"])) {
    header('Location: /MainMenu/main-page.php');
    exit;
}
// Getting profile info from the database
$stmt = $mysqli->prepare('SELECT password, email, username FROM users WHERE id = ?');

// Using account id for getting information on the profile
$userid = $_COOKIE["userid"];
$stmt->bind_param('i', $userid);
$stmt->execute();
$stmt->bind_result($password, $email, $username);
$stmt->fetch();
$stmt->close();
$mysqli->close();
