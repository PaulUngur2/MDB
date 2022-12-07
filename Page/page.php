<?php
// Connecting to the database
require_once __DIR__ . '/page-config.php';
global $mysqli;

// Query and result
$sql = 'SELECT name, lchapter, genre, status, rating, img FROM Mangadb';

$result = mysqli_query($mysqli, $sql);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<h4 class ="center grey-text"> DATA</h4>
<div class="container">
    <div class="row">
        <?php foreach($data as $line){ ?>
            <div class="column">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6> <?php echo htmlspecialchars($line['name']) ?>  </h6>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</html>
