<?php

// Connecting to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Check if the necessary POST variables are set
if (isset($_POST['email'], $_POST['password'], $_POST['cPassword'])) {
    // Get the token value from the POST data
    $token = $_POST['token'];

    // Prepare a SELECT statement to get the email of a user with a matching token
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE token = ?");

    // Bind the token value as a parameter to the prepared statement
    $stmt->bind_param('s', $token);

    // Execute the prepared statement
    $stmt->execute();

    // Store the result of the statement
    $stmt->store_result();

    // Check if a user was found with the given token
    if ($stmt->num_rows > 0) {

        // Bind the result of the SELECT statement to the $tokenEmail variable
        $stmt->bind_result($tokenEmail);
        $stmt->fetch();

        // Check if the password and confirm password do not match
        if ($_POST['password'] != $_POST['cPassword']) {
            echo 'Passwords do not match';
        }
        // Check if the password is less than 8 characters long
        else if (strlen($_POST['password']) < 8) {
            echo 'Password must be at least 8 characters long';
        }
        // Check if the email does not match the email associated with the token
        else if ($_POST['email'] != $tokenEmail) {
            echo 'Wrong email';
        }
        // If none of the above conditions are met, update the user's password
        else {
            // Hash the password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Prepare an UPDATE statement to update the user's password and reset the token
            $stmt->prepare("UPDATE users SET password = ?, token = '' WHERE email = ?");

            // Bind the hashed password and email as parameters to the prepared statement
            $stmt->bind_param('ss', $password, $_POST['email']);

            // Execute the prepared statement
            $stmt->execute();

            // Print a success message
            echo 'Your password has been successfully reset. <a href="../Login/login-page.php" class="formLink">Go back</a>';
        }

    }
    // If no user was found with the given token, print an error message
    else {
        echo 'Wrong email';
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the MySQL connection
$mysqli->close();
