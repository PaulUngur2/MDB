<?php

// Connect to the database
require_once("/var/www/MDB/Login/login-config.php");
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
        echo "Name already is in the database";
        exit();
    } else {
        // Get form data
        $id = $_POST['id'];
        $image = $_POST['image'];
        $lChapter = $_POST['lChapter'];
        $status = $_POST['status'];
        $name = $_POST['name'];
        $genres = $_POST['genre'];
        $description = nl2br($_POST['description']);
        $author = $_POST['author'];

        // Escape the form data to prevent SQL injection attacks
        $id = mysqli_real_escape_string($mysqli, $id);
        $image = mysqli_real_escape_string($mysqli, $image);
        $lChapter = mysqli_real_escape_string($mysqli, $lChapter);
        $status = mysqli_real_escape_string($mysqli, $status);
        $name = mysqli_real_escape_string($mysqli, $name);
        $genres = mysqli_real_escape_string($mysqli, $genres);
        $description = mysqli_real_escape_string($mysqli, $description);
        $author = mysqli_real_escape_string($mysqli, $author);

        // Build the update query
        $query = "UPDATE Mangadb SET";
        if (!empty($image) && filter_var($image, FILTER_VALIDATE_URL)) {
            $query .= " img = '$image',";
        }
        if (!empty($lChapter)) {
            $query .= " lchapter = '$lChapter',";
        }
        if (!empty($status)) {
            $query .= " status = '$status',";
        }
        if (!empty($name)) {
            $query .= " name = '$name',";
        }
        if (!empty($genres)) {
            $query .= " genre = '$genres',";
        }
        if (!empty($description)) {
            $query .= " description = '$description',";
        }
        if (!empty($author)) {
            $query .= " author = '$author',";
        }
        // Remove the trailing comma
        $query = rtrim($query, ',');
        // Add the WHERE clause to the query
        $query .= " WHERE id = '$id'";
        // Execute the update query
        $result = mysqli_query($mysqli, $query);

        // Redirect to the page for the updated manga series
        echo 'http://localhost/Page/page.php?id=' . $id;
        exit();
    }

}
// Close the database connection
mysqli_close($mysqli);