<?php
// Connecting to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

if(isset($_REQUEST["term"])){

    // Prepare a select statement
    if($stmt = $mysqli->prepare("SELECT name FROM Mangadb WHERE name LIKE ? LIMIT 5")){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_term);

        // Set parameters
        $param_term = $_REQUEST["term"] . '%';

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();

            // Check number of rows in the result set
            if($result->num_rows > 0){
                // Fetch result rows as an associative array
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    echo "<p>" . $row["name"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute sql. ";
        }
    }

    // Close statement
    $stmt->close();
}

// Close connection
$mysqli->close();