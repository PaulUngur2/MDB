<?php
// Connecting to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Waiting until the data was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Checking if the data is submitted
    if ( !isset($_POST['username'], $_POST['password']) ) {

        exit('Please fill both the username and password fields');
    }

    // Preparing SQL
    if ($stmt = $mysqli->prepare('SELECT id, password FROM users WHERE username = ?')) {

        // We bind a string, so we use s for the type
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result, so we can check if the account exists in the database

        // If there is a result we save the id and password
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();

            // Verifying the passwords
            if (password_verify($_POST['password'], $password)) {

                setcookie("login", "1", time() + 3600, "/");
                setcookie("userid", $id, time() + 3600, "/");
                header('Location: /Profile/profile.php');
            } else {

                echo 'Incorrect username and/or password!';
            }
        } else {

            echo 'Incorrect username and/or password!';
        }
        $stmt->close();
    }
}
$mysqli->close();