<?php

// Include the login-config.php file to establish a database connection
require_once("/var/www/MDB/Login/login-config.php");
// Make the database connection available globally
global $mysqli;

// Check if the "name" form input is set
if(isset($_POST['name'])){
    // Store the form data in variables
    $name = $_POST['name'];
    // Use prepared statements to prevent SQL injection attacks
    $stmt = $mysqli->prepare("SELECT * FROM Mangadb WHERE name = '$name'");
    // Execute the prepared statement
    $stmt->execute();
    // Store the results
    $stmt->store_result();
    // Check if the query returned any results
    if ($stmt->num_rows > 0) {
        // Name is in the database
        echo "Series is in the database";
        exit();
    } else {
        // If the name is not in the database, store the rest of the form data in variables
        $image = $_POST['image'];
        $lChapter = $_POST['lChapter'];
        $status = $_POST['status'];
        $genres = $_POST['genre'];
        $description = nl2br($_POST['description']);
        $author = $_POST['author'];

        // Escape the form data to prevent SQL injection attacks
        $image = mysqli_real_escape_string($mysqli, $image);
        $lChapter = mysqli_real_escape_string($mysqli, $lChapter);
        $status = mysqli_real_escape_string($mysqli, $status);
        $name = mysqli_real_escape_string($mysqli, $name);
        $genres = mysqli_real_escape_string($mysqli, $genres);
        $description = mysqli_real_escape_string($mysqli, $description);
        $author = mysqli_real_escape_string($mysqli, $author);

        // Build the INSERT query
        $query = "INSERT INTO Mangadb (";
        // Check if the image URL is set and is a valid URL
        if (!empty($image) && filter_var($image, FILTER_VALIDATE_URL)) {
            $query .= "img,";
        }
        // Check if the last chapter is set
        if (!empty($lChapter)) {
            $query .= "lchapter,";
        }
        // Check if the status is set
        if (!empty($status)) {
            $query .= "status,";
        }
        // Check if the name is set
        if (!empty($name)) {
            $query .= "name,";
        }
        // Check if the genre is set
        if (!empty($genres)) {
            $query .= "genre,";
        }
        // Check if the description is set
        if (!empty($description)) {
            $query .= "description,";
        }
        // Check if the author is set
        if (!empty($author)) {
            $query .= "author,";
        }
        // Remove the trailing comma
        $query = rtrim($query, ',');

        $query .= ") VALUES (";
        // Check if the image URL is set and is a valid URL
        if (!empty($image) && filter_var($image, FILTER_VALIDATE_URL)) {
            $query .= "'$image',";
        }
        // Check if the last chapter is set
        if (!empty($lChapter)) {
            $query .= "'$lChapter',";
        }
        // Check if the status is set
        if (!empty($status)) {
            $query .= "'$status',";
        }
        // Check if the name is set
        if (!empty($name)) {
            $query .= "'$name',";
        }
        // Check if the genre is set
        if (!empty($genres)) {
            $query .= "'$genres',";
        }
        // Check if the description is set
        if (!empty($description)) {
            $query .= "'$description',";
        }
        // Check if the author is set
        if (!empty($author)) {
            $query .= "'$author',";
        }
        // Remove the trailing comma
        $query = rtrim($query, ',');

        $query .= ")";
        // Execute the INSERT query
        mysqli_query($mysqli, $query);
        $stmt->prepare("SELECT id FROM Mangadb WHERE name = '$name'");
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        // If the INSERT query was successful, redirect to the main page
        echo 'http://localhost/Page/page.php?id=' . $id;
        exit();
    }
    $stmt->close();
    // Close the database connection
    mysqli_close($mysqli);
}