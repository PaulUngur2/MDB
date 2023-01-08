<?php

// Connect to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

// If the user is not logged in, redirect to the login page
if(!isset($_COOKIE["login"])) {
    header('Location: /MainMenu/main-page.php');
    exit;
}

// Get the user's id from the 'userid' cookie
$user = $_COOKIE['userid'];

// Prepare a SELECT statement to join the Mangadb and userslist tables and select rows where the users column in the userslist
// table matches the user's id and the titles column in the userslist table matches the id column in the Mangadb table
$stmt = $mysqli->prepare("SELECT a.name, a.status, a.img, b.rating, b.titles FROM Mangadb a INNER JOIN userslist b on a.id = b.titles WHERE b.users = '{$user}' and b.titles = a.id;");

// Execute the statement
$stmt->execute();

// Store the result of the statement
$stmt->store_result();

// Bind the result columns to variables
$stmt->bind_result($name, $status, $img, $rating, $id);

// Display a table with the results
?>
    <table class="box table text-white">
        <thead>
        <tr>
            <th>     </th>
            <th>Name</th>
            <th>Status</th>
            <th>Your Rating</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Fetch each row from the result set and display it as a table row
        while ($row = $stmt->fetch()){  ?>
            <tr>
                <!-- Display the image and name of the manga in a link to the page.php page with the manga's id as a GET parameter -->
                <td><a href="http://localhost/Page/page.php?id=<?= $id ?>"><img src="../images/default-avatar.png" data-src="<?= $img ?>" class="img mb-4 rounded shadow lazyload" alt="<?= $name; ?>"></a></td>
                <td><a class="link" href="http://localhost/Page/page.php?id=<?= $id ?>"><?= $name; ?></a></td>
                <td><?= $status; ?></td>
                <td><?= $rating; ?>/5</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php

// Close the statement and database connection
$stmt->close();
$mysqli->close();
