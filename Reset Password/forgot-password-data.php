<?php

// Connect to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Check if the email is set in the POST request
if (isset($_POST['email'])){
    // Get the email from the POST request
    $email = $_POST["email"];

    // Prepare and execute a SELECT query to check if the email exists in the database
    $stmt = $mysqli->prepare("SELECT * FROM users where email = '$email'");
    $stmt->execute();
    $stmt->store_result();

    // Check if the email field is empty
    if (empty($email)){
        echo "Field is empty";
    } else {
        // Check if the email exists in the database
        if ($stmt->num_rows > 0){
            // Generate a unique token
            $token = uniqid(md5(time()));
            // Prepare and execute an UPDATE query to set the token for the user with the specified email
            $stmt->prepare("UPDATE users SET token = '$token' WHERE email = '$email'");
            $stmt->execute();

            // Set up the email parameters
            $to = $email;
            $subject = "Password Reset";
            $message = "Hello, <br> Here is the <a href='http://localhost/Reset%20Password/reset-password-page.php?token=$token'>link</a> to reset your password.<br><br>Best regards MangaDB staff team.";
            $headers = "From: mangadatab@gmail.com" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=utf-8";

            // Send the email
            if (mail($to,$subject,$message,$headers)) {
                // If the mail was sent successfully, send a success message
                echo "Password link has been sent to your mail";
            } else {
                // If the mail was not sent successfully, send an error message
                echo "Failed to send to your mail";
            }
        } else {
            // If the email does not exist in the database, send an error message
            echo "User not found";
        }
    }
    // Close the statement
    $stmt->close();
}
// Close the connection
$mysqli->close();