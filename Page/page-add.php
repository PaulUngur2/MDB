<?php

// Connect to the database using login-config.php file
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Check if the form has been submitted with a mangaId value
if(isset($_POST['mangaId'])){
    // Prepare a SELECT statement to check if the current user has already added this manga to their list
    $stmt = $mysqli->prepare('SELECT * FROM userslist WHERE users = ? AND titles = ?');
    // Bind the userid and mangaId values as parameters to the statement
    $stmt->bind_param('ii', $_COOKIE['userid'], $_POST['mangaId']);
    // Execute the statement
    $stmt->execute();
    // Store the result of the statement
    $stmt->store_result();

    // Check if there are any rows in the result set
    if($stmt->num_rows > 0){
        // If there are rows, then the user has already added this manga to their list.
        // Prepare a DELETE statement to remove the manga from the list
        $stmt->prepare('DELETE FROM userslist WHERE users = ? AND titles = ?');
        // Bind the userid and mangaId values as parameters to the statement
        $stmt->bind_param('ii', $_COOKIE['userid'], $_POST['mangaId']);
        // Execute the DELETE statement
        $stmt->execute();
        // Return "Deleted" to the AJAX request
        echo "Deleted";
    } else {
        // If there are no rows, then the user has not yet added this manga to their list.
        // Prepare an INSERT statement to add the manga to the list
        $stmt->prepare('INSERT INTO userslist (users, titles) VALUES (?, ?)');
        // Bind the userid and mangaId values as parameters to the statement
        $stmt->bind_param('ii', $_COOKIE['userid'], $_POST['mangaId']);
        // Execute the INSERT statement
        $stmt->execute();
        //Return "Added" to the AJAX request
        echo "Added";
    }
    // Close the statement
    $stmt->close();
}
// Close the database connection
$mysqli->close();