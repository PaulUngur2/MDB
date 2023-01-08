<?php

// Connecting to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Waiting until the data was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if a user with the submitted username exists in the database
    if ($stmt = $mysqli->prepare('SELECT id, password, username FROM users WHERE username = ?')) {

        // Bind the submitted username as a string to the prepared statement
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result, so we can check if the account exists in the database

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password, $username);
            $stmt->fetch();

            // Verify that the submitted password matches the hashed password in the database
            if (password_verify($_POST['password'], $password)) {
                // Set cookies to remember the login
                setcookie("login", "$username", time() + 3600, "/");
                setcookie("userid", $id, time() + 3600, "/");
            } else {
                echo "Incorrect Password";
            }
        }
        // If no user with the submitted username was found, check if a user with the submitted email exists
        else if ($stmt = $mysqli->prepare('SELECT id, password, username FROM users WHERE email = ?')) {

            // Bind the submitted email as a string to the prepared statement
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password, $username);
                $stmt->fetch();
                // Verify that the submitted password matches the hashed password in the database
                if (password_verify($_POST['password'], $password)) {
                    // Set cookies to remember the login
                    setcookie("login", "$username", time() + 3600, "/");
                    setcookie("userid", $id, time() + 3600, "/");
                } else {
                    echo "Incorrect Password";
                }
            } else {
                echo "Incorrect Username/Email";
            }
        } else {
            echo "Incorrect Username/Email";
        }
        $stmt->close();
    }
}
$mysqli->close();
