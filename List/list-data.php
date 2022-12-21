<?php

// Connecting to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

// If the user isn't logged it, redirect to login page
if(!isset($_COOKIE["login"])) {
    header('Location: /MainMenu/main-page.php');
    exit;
}
$user = $_COOKIE['userid'];

$stmt = $mysqli->prepare("SELECT a.name, a.status, a.img, b.rating, b.titles FROM Mangadb a INNER JOIN userslist b on a.id = b.titles WHERE b.users = '{$user}' and b.titles = a.id;");
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $status, $img, $rating, $id);
?>
    <table class="box table">
        <thead>
        <tr>
            <th>     </th>
            <th>Name</th>
            <th>Status</th>
            <th>Rating</th>
        </tr>
        </thead>
        <tbody>

        <?php
        while ($row = $stmt->fetch()){  ?>
            <tr>
                <td><a href="http://localhost/Page/page.php?id=<?= $id ?>"><img src="<?= $img ?>" class="img mb-4 rounded shadow" alt="<?= $name; ?>"></a></td>
                <td><a class="links" href="http://localhost/Page/page.php?id=<?= $id ?>"><?= $name; ?></a></td>
                <td><?= $status; ?></td>
                <td><?= $rating; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php
$stmt->close();
$mysqli->close();