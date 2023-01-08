<?php

// Connect to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Check if the input variable has been set in the POST request
if (isset($_POST['input'])){

    // Get the value of the input variable
    $input = $_POST["input"];

    // Prepare a SELECT statement to search for rows in the Mangadb table where the name column starts with the value of the input variable
    $stmt = $mysqli->prepare("SELECT id, name, genre, status, img, rating FROM Mangadb WHERE name LIKE '{$input}%' ");

    // Execute the statement
    $stmt->execute();

    // Store the result of the statement
    $stmt->store_result();

    // Bind the results to variables
    $stmt->bind_result($id,$name, $genre, $status, $img, $rating);

    // If the statement returns more than 0 rows
    if ($stmt->num_rows > 0){ ?>

        <!-- Display a table with the search results -->
        <table class="boxTable table mt-4">
            <thead>
            <tr>
                <th>     </th>
                <th>Name</th>
                <th>Status</th>
                <th>Genre</th>
                <th>Rating</th>
            </tr>
            </thead>
            <tbody>

            <?php
            // Fetch each row of the result set
            while ($row = $stmt->fetch()){  ?>
                <tr>
                    <!-- Display the image and name of the manga in a link to the page.php page with the manga's id as a GET parameter -->
                    <td><a href="http://localhost/Page/page.php?id=<?= $id ?>"><img src="../images/default-avatar.png" data-src="<?= $img ?>" class="img mb-4 rounded shadow lazyload" alt="<?= $name; ?>"></a></td>
                    <td><a class="link" href="http://localhost/Page/page.php?id=<?= $id ?>"><?= $name; ?></a></td>
                    <!-- Display the status, genre, and rating of the manga -->
                    <td><?= $status; ?></td>
                    <td><?= $genre; ?></td>
                    <td><?= $rating; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <?php
    }
    // If the statement returns 0 rows
    else {
        // Display a message saying no data was found
        echo " <h6 class='text-danger text-center mt-3'> No data Found </h6>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$mysqli->close();