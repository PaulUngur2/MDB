<?php
// Connecting to the database
require_once __DIR__ . '/login-config.php';
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

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            // Account exists, now we verify the password.

            if (password_verify($_POST['password'], $password)) {

                // Sessions to know the user is logged in
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                echo 'Welcome ' . $_SESSION['name'] . '!';
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