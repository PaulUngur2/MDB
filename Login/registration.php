<?php

//Connecting to the database
require_once __DIR__ . '/login-config.php';
global $mysqli;

//Initializing with empty values
$username = $email = $password = $confirmPassword = "";
$usernameError = $emailError = $passwordError = $confirmPasswordError = "";


if (!isset($_SERVER["REQUEST_METHOD"]) || !isset($_SERVER)) {
    $_SERVER["REQUEST_METHOD"] = "POST";
}

if (!isset($_POST["signupUsername"]) || !isset($_POST)) {
    $_POST["signupUsername"] = "myusername";
}

if (!isset($_POST["email"]) || !isset($_POST)) {
    $_POST["email"] = "user@example.com";
}

if (!isset($_POST["signupPassword"]) || !isset($_POST)) {
    $_POST["signupPassword"] = "mypassword";
}

if (!isset($_POST["signupConfirmPassword"]) || !isset($_POST)) {
    $_POST["signupConfirmPassword"] = "mypassword";
}

// Processing the data when the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["signupUsername"]))){
        $usernameError = "Please enter an username";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["signupUsername"]))) {
        $usernameError = "Username can only contain letters, numbers and underscores";
    } else {

        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = $mysqli->prepare($sql)){

            // Bind variables as parameters
            $stmt->bind_param("s",$paramUsername);

            // Set the parameters
            $paramUsername = trim($_POST["signupUsername"]);

            // Try executing the statement
            if($stmt->execute()){

                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $usernameError = "This username is already taken";
                } else {
                    $username = trim($_POST["signupUsername"]);
                }
            }else {
                echo "Something went wrong. Try again";
            }
            // Close statement
            $stmt->close();
        }
    }
    // Validate email
    if(empty(trim($_POST["email"]))){
        $emailError = "Please enter an email";
    } elseif (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', trim($_POST["email"]))) {
        $emailError = "Invalid Email";
    } else {

        $sql = "SELECT id FROM users WHERE email = ?";


        if($stmt = $mysqli->prepare($sql)){

            // Bind variables as parameters
            $stmt->bind_param("s",$paramEmail);

            // Set the parameters
            $paramEmail = trim($_POST["email"]);

            // Try executing the statement
            if($stmt->execute()){

                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $emailError = "This email is already taken";
                } else {
                    $email = trim($_POST["email"]);
                }
            }else {
                echo "Something went wrong. Try again";
            }
            // Close statement
            $stmt->close();
        }
    }

    // Validate password
    if(empty(trim($_POST["signupPassword"]))){
        $passwordError = "Please enter a password";
    } elseif(strlen(trim($_POST["signupPassword"])) < 8){
        $passwordError = "Password must have at least 8 characters";
    } else {
        $password = trim($_POST["signupPassword"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["signupConfirmPassword"]))){
        $confirmPasswordError = "Please confirm password";
    } else {
        $confirmPassword = trim($_POST["signupConfirmPassword"]);
        if(empty($passwordError) && ($password != $confirmPassword)){
            $confirmPasswordError = "Password did not match";
        }
    }

    // Check for errors before inserting
    if(empty($usernameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError)){
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){

            $stmt->bind_param("sss", $paramUsername, $paramEmail, $paramPassword);

            $paramUsername = $username;
            $paramEmail = $email;
            $paramPassword = password_hash($password, PASSWORD_DEFAULT); //Password hash

            if($stmt->execute()){
                header("location: login.php");
            } else {
                echo "Something went wrong. Try again";
            }
            // Close statement
            $stmt->close();
        }
    }
    // Close connection
    $mysqli->close();
}

