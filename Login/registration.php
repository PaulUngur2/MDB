<?php

// Connect to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Wait until the data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the username already exists
    // Prepare SQL statement
    if ($stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ?')) {

        // Bind string to the statement (using 's' for the type)
        $stmt->bind_param('s', $_POST['signupUsername']);
        $stmt->execute();
        $stmt->store_result();
        // Store result to check if the account exists in the database

        if ($stmt->num_rows > 0) {
            // If the username already exists, display an error message
            echo 'Username already exists';
        } else if ($stmt = $mysqli->prepare('SELECT * FROM users WHERE email = ?')) {
            // Check if the email already exists
            $email = $_POST['signupEmail'];

            // Bind the email to the statement
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // If the email already exists, display an error message
                echo 'Email already exists';
            } else {
                // If the email and username are unique, insert the new user into the database
                if ($stmt = $mysqli->prepare('INSERT INTO users (username, password, email, activation) VALUES (?, ?, ?, ?)')) {
                    // Validate the email
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo 'Email is not valid';
                    }

                    // Validate the username
                    if (!preg_match('/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{6,29}/', $_POST['signupUsername'])) {
                        echo 'Username is not valid';
                    }
                    /* A valid username must be between 6 and 29 characters long and can contain letters, numbers, underscores,
                    and dots, as long as it does not start or end with a dot and does not contain ".." anywhere.*/

                    // Validate the password
                    if (strlen($_POST['signupPassword']) < 8) {
                        echo 'Password must be at least 8 characters long';
                    }

                    // Validate the confirm password
                    if ($_POST['signupPassword'] != $_POST['signupConfirmPassword']) {
                        echo 'Passwords are not matching';
                    }

                    // Hash the password for security
                    $password = password_hash($_POST['signupPassword'], PASSWORD_DEFAULT);

                    // Generate an activation token
                    $activation = uniqid(md5(time()));

                    // Bind the variables to the statement (using 's' for each variable)
                    $stmt->bind_param('ssss', $_POST['signupUsername'], $password, $email, $activation);
                    $stmt->execute();

                    // Set up email variables
                    $to = $email;
                    // Set up variables for email message
                    $subject = "Account Activation";
                    $message = "Hello, <br> Here is the <a href='http://localhost/Profile/activate.php?token=$activation&email=$email'>link</a> to activate your account.<br><br>Best regards MangaDB staff team.";
                    $headers = "From: mangadatab@gmail.com" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=utf-8";

                    // Send email to user with activation link
                    if (mail($to, $subject, $message, $headers)) {
                        echo 'Your account has been successfully created and a link has been sent to your mail to activate your account. <a href="../Login/login-page.php" class="formLink">Go to the login page.</a>';
                    } else {
                        echo "Failed to send to your mail";
                    }

                    // If prepare statement fails
                } else {
                    echo 'Could not prepare statement';
                }

                // Close connection
                $mysqli->close();
            }
        }
    }
}