<?php

// Connecting to the database
require_once ("/var/www/MDB/Login/login-config.php");
global $mysqli;

if (isset($_POST['input'])){

    $input = $_POST['input'];

    $stmt = $mysqli->prepare("SELECT id, name, genre, status, img, rating FROM Mangadb WHERE name like '{$input}%'");
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id,$name, $genre, $status, $img, $rating);
    if ($stmt->num_rows > 0){ ?>

        <table class="boxt table mt-4">
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
            while ($row = $stmt->fetch()){  ?>
            <tr>
                <td><img src="<?= $img ?>" class="img mb-4 rounded shadow" alt="Responsive image"></td>
                <td><?= $name; ?></td>
                <td><?= $status; ?></td>
                <td><?= $genre; ?></td>
                <td><?= $rating; ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <?php
    } else {

        echo " <h6 class='test-danger text-center mt-3'> No data Found </h6>";
    }

    $stmt->close();
}

$mysqli->close();