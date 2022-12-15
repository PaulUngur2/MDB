<?php
// Connecting to the database
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Waiting until the data was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Preparing SQL
    if ($stmt = $mysqli->prepare('SELECT id FROM Mangadb WHERE name = ?')){

        $stmt->bind_param('s',$_POST['page']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0){

            $stmt->bind_result($id);
            $stmt->fetch();

            setcookie("mangaid", $id, time() + 3600, "/");
            header('Location: /Page/page.php');
        } else {
            header('Location: /Browse/browse-page.php');
        }
        $stmt->close();
    }


}
$mysqli->close();