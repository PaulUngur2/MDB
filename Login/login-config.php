<?php

//Connecting to the database
$mysqli = new mysqli('localhost', 'admin_user', 'secret_password', 'login');

//Checking the connection
if ($mysqli === false) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}