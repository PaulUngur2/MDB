<?php

// Connecting to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Waiting until the data was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// Checking if the data is submitted
    if (!isset($_POST['signupUsername'], $_POST['signupEmail'], $_POST['signupPassword'], $_POST['signupConfirmPassword'])) {

        exit('Please complete the registration form');
    }

// Checking if any values are empty
    if (empty($_POST['signupUsername'] || $_POST['signupEmail'] || $_POST['signupPassword'] || $_POST['signupConfirmPassword'])) {

        exit('Please complete the registration form');
    }

// Checking if the username exists
    // Preparing SQL
    if ($stmt = $mysqli->prepare('SELECT id, password FROM users WHERE username = ? AND email = ?')) {

        //We bind a string, so we use s for the type
        $stmt->bind_param('ss', $_POST['signupUsername'], $_POST['signupEmail']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result, so we can check if the account exists in the database

        if ($stmt->num_rows > 0) {

            if ($stmt = $mysqli->prepare('SELECT id, password FROM users WHERE username = ?')) {

                //We bind a string, so we use s for the type
                $stmt->bind_param('s', $_POST['signupUsername']);
                $stmt->execute();
                $stmt->store_result();
                // Store the result, so we can check if the account exists in the database

                if ($stmt->num_rows > 0) {
                    exit('error-username');
                } else {
                    exit('error-email');
                }
            }
        } else {
            if ($stmt = $mysqli->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {

                // Email checker
                if (!filter_var($_POST['signupEmail'], FILTER_VALIDATE_EMAIL)) {
                    exit('Email is not valid');
                }

                // Username checker
                if (!preg_match('/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{6,29}/', $_POST['signupUsername'])) {
                    exit('Username is not valid');
                }
                /* A valid username that is between 6 and 29 characters long, and Can contain letters, numbers, underscores,
                and dots, as long as it does not start or end with a dot and does not contain .. anywhere.*/

                // Password checker
                if (strlen($_POST['signupPassword']) < 8) {
                    exit('Password must be between at least 8 characters long');
                }

                // ConfirmPassword checker
                if ($_POST['signupPassword'] != $_POST['signupConfirmPassword']) {
                    exit('Passwords are not matching');
                }

                $password = password_hash($_POST['signupPassword'], PASSWORD_DEFAULT);

                //We bind a string, so we use s for the type, and s for every variable
                $stmt->bind_param('sss', $_POST['signupUsername'], $password, $_POST['signupEmail']);
                $stmt->execute();
                header('Location: /Login/login-page.php');
            } else {

                echo 'Could not prepare statement';
            }
        }
        $stmt->close();
    }
}
$mysqli->close();