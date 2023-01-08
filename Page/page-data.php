<?php

// Connecting to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Check if rating and id have been received via POST request
if (isset($_POST['rating'],$_POST['id'])){
    // Update rating for user with given id in the 'userslist' table
    $stmt = $mysqli->prepare('UPDATE userslist SET rating = ? WHERE users = ? AND titles = ?');
    // Bind the rating, userid and mangaId values as parameters to the statement
    $stmt->bind_param('iii', $_POST['rating'], $_COOKIE['userid'], $_POST['id']);
    // Execute the statement
    $stmt->execute();

} else {
    // Retrieve name, last chapter, genre, status, rating, image, description, and author for manga series with given id
    $stmt = $mysqli->prepare('SELECT name, lchapter, genre, status, rating, img, description, author FROM Mangadb WHERE id = ?');
    // Bind the mangaId value as a parameter to the statement
    $stmt->bind_param('i', $_GET['id']);
    // Execute the statement
    $stmt->execute();
    // Store the result of the statement
    $stmt->bind_result($name, $lchapter, $genre, $status, $rating, $img, $description, $author);
    // Fetch the result of the statement
    $stmt->fetch();

    // Get rating for series from 'userslist' table for current user
    $stmt->prepare('SELECT rating FROM userslist WHERE users = ? AND titles = ?');
    // Bind the userid and mangaId values as parameters to the statement
    $stmt->bind_param('ii', $_COOKIE['userid'], $_GET['id']);
    // Execute the statement
    $stmt->execute();
    // Store the result of the statement
    $stmt->store_result();

    // If user has rated series, set $added to "Added", otherwise set it to "Add it to list"
    if ($stmt->num_rows > 0) {
        $added = "Added";
    } else {
        $added = "Add it to list";
    }
    //Bind the result of the statement to the $userRating variable
    $stmt->bind_result($userRating);
    // Fetch the result of the statement
    $stmt->fetch();
}

// Close statement and database connection
$stmt->close();
// Close the database connection
$mysqli->close();
