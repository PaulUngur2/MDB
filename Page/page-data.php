<?php
// Connecting to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Getting profile info from the database
$stmt = $mysqli->prepare('SELECT name, lchapter, genre, status, rating, img, description FROM Mangadb WHERE id = ?');

// Using account id for getting information on the profile
$mangaid = $_COOKIE["mangaid"];
$stmt->bind_param('i', $mangaid);
$stmt->execute();
$stmt->bind_result($name, $lchapter, $genre, $status, $rating, $img, $description);
$stmt->fetch();
$stmt->close();
$mysqli->close();