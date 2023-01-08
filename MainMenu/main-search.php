<?php

// Connect to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Check if data has been submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Prepare a SQL statement
    if ($stmt = $mysqli->prepare('SELECT id FROM Mangadb WHERE name = ?')){

        // Bind the POST data to the statement as a parameter
        $stmt->bind_param('s',$_POST['page']);

        // Execute the statement
        $stmt->execute();

        // Store the result
        $stmt->store_result();

        // If there are rows in the result set...
        if ($stmt->num_rows > 0){
            // Bind the result data to variables
            $stmt->bind_result($id);
            $stmt->fetch();

            // Redirect to the page with the matching title
            header("Location: http://localhost/Page/page.php?id=$id");
        } else {
            // If no matching title was found, store the search term in a cookie and redirect to the browse page
            $title = $_POST['page'];
            setcookie("title", $title, time() + 3600, "/");
            header('Location: /Browse/browse-page.php');
        }
        // Close statement
        $stmt->close();
    }

}

// Close connection
$mysqli->close();
