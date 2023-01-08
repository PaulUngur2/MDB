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
$stmt = $mysqli->prepare('SELECT email, username, activation FROM users WHERE id = ?');

// Using account id for getting information on the profile
$userid = $_COOKIE["userid"];

// Binding the id to the query
$stmt->bind_param('i', $userid);
// Executing the query
$stmt->execute();

// Storing the result
$stmt->bind_result( $email, $username, $activation);
// Fetching the result
$stmt->fetch();


// If the user's account is activated show Activated if it isn't show Not activated and a link to send the activation email again
if ($activation != "activated") {
    $activation = "Not Activated,   <a href='' class='resendEmail link' id='resendEmail'>Resend email?</a>";
} else {
    $activation = "Activated";
}
// Closing statement
$stmt->close();
// Closing connection
$mysqli->close();
