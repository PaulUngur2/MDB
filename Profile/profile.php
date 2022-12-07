<?php
// Connecting to the database
require_once __DIR__ . '/Login/login-config.php';
global $mysqli;

session_start();

// If the user isn't logged it, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: /Login/login.php');
    exit;
}

// Getting profile info from the database
$stmt = $mysqli->prepare('SELECT password, email FROM accounts WHERE id = ?');

// Using account id for getting information on the profile
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
$mysqli->close();
