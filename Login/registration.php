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
    if ($stmt = $mysqli->prepare('SELECT id, password FROM users WHERE username = ?')) {

        //We bind a string, so we use s for the type
        $stmt->bind_param('s', $_POST['signupUsername']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result, so we can check if the account exists in the database

        if ($stmt->num_rows > 0) {

            echo 'Username exists, please choose another';

        } else {
            if ($stmt = $mysqli->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {

                // Email checker
                if (!filter_var($_POST['signupEmail'], FILTER_VALIDATE_EMAIL)) {
                    exit('Email is not valid');
                }

                // Username checker
                if (!preg_match('/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}/', $_POST['signupUsername'])) {
                    exit('Username is not valid');
                }
                /* The (?!.*\.\.) and (?!.*\.$) expressions use negative lookaheads to assert that the string does not contain two consecutive dots ("..") or a dot at the end (".$").
                This is useful for preventing the use of special directory names, such as ".." and ".", which can be used to access files outside the intended directory.
                The [^\W] character class matches any character that is not a non-word character.
                A non-word character is any character that is not a letter, number, or underscore. This character class is used to ensure that the string starts with a letter or number.
                The [\w.] character class matches any letter, number, underscore, or dot. This character class is used to match the rest of the string, which can contain any combination of these characters.
                The {0,29} expression is a quantifier that specifies that the previous character class ([\w.]) can be repeated between 0 and 29 times.
                This means that the string can be any length between 1 and 30 characters, including the starting character matched by the [^\W] character class.*/

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