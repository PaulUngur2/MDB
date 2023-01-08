<?php
// Connecting to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;
// Check if the email was sent
if(isset($_POST['email'])) {
    // Save the email in a variable
    $email = $_POST['email'];

    // Creating the token with the uniqid() function
    $token = uniqid(md5(time()));

    // Preparing an UPDATE query to set the token to the user's account
    $stmt = $mysqli->prepare("UPDATE users SET token = '$token' WHERE email = '$email'");
    // Executing the query
    $stmt->execute();
    // Sending the $token to the AJAX
    echo $token;
    exit();
    // Closing statement
    $stmt->close();
}
// Closing connection
$mysqli->close();



