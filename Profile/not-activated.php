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
$stmt = $mysqli->prepare('SELECT email FROM users WHERE id = ?');

// Using account id for getting information on the profile
$userid = $_COOKIE["userid"];

// Binding the id to the query
$stmt->bind_param('i', $userid);
// Executing the query
$stmt->execute();

// Storing the result
$stmt->bind_result( $email);
// Fetching the result
$stmt->fetch();

// Creating a variable for the activation code using uniqid()
$activation = uniqid(md5(time()));

// Preparing an UPDATE query to set the activation code to the user's account
$stmt->prepare('UPDATE users SET activation = ? WHERE email = ?');
// Binding the activation code and the email to the query
$stmt->bind_param('ss', $activation,  $email);
// Executing the query
$stmt->execute();

// Building the email message
$to = $email;
$subject = "Account Activation";
$message = "Hello, <br> Here is the <a href='http://localhost/Profile/activate.php?token=$activation&email=$email'>link</a> to activate your account.<br><br>Best regards MangaDB staff team.";
$headers = "From: mangadatab@gmail.com" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=utf-8";

// Sending the email
mail($to,$subject,$message,$headers);
// Closing statement
$stmt->close();
// Closing connection
$mysqli->close();
