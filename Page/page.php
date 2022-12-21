<?php include("page-data.php");
global $name, $lchapter, $genre, $status, $rating, $img, $description;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $name ?></title>
    <link rel="icon" href="../images/site-favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="page.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="page.js" type="text/javascript"></script>
</head>

<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../MainMenu/main-page.php"> <img src="../images/site-icon.png" alt="logo" class="icon"></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="mynavbar" class="navbar-collapse collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../MainMenu/main-page.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Browse/browse-page.php">Browse</a>
                </li>

                <?php if(isset($_COOKIE["login"])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../List/list-page.php">Manga List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Profile/profile-page.php">Profile</a>
                    </li>
                <?php } ?>
            </ul>

            <ul class="navbar-nav navbar-right">
                <?php if(!isset($_COOKIE["login"])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/login-page.php"><span class="bi bi-box-arrow-in-right"></span> Login/SignUp</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/logout.php"><span class="bi bi-box-arrow-left"></span> Logout</a>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </div>
</nav>

<div class="container-fluid pt-1">
    <div class="row content">
        <div class="col-sm-2 sidenav text-center">
            <img src="<?= $img ?>" class="img-fluid  mb-4 rounded shadow" alt="Responsive image">
            <form action="page-add.php" method="post">
                <button type="button" class="btn btn-block mb-3 ps-xxl-5 pe-xxl-5 button border-0" id="submitButton">Add it to list</button>
            </form>
            <div class="box container-fluid rounded p-2">
                <h5>Latest chapter: <?= $lchapter ?></h5>
                <h5>Status: <?= $status ?></h5>
                <h5>Rating: <?= $rating ?>/5</h5>
            </div>
        </div>
        <div class="col-sm-8 text-left">
            <div class="box container-fluid rounded p-3 mt-5">
                <h5><?= $name ?></h5>
                <br>
                <p class="lead" >Genres: <?= $genre ?></p>
            </div>
            <div class="box container-fluid rounded p-3 mt-5">
                <p class="lead"><small>Description:</small></p>
                <p class="lead"> <?= $description ?> </p>
            </div>
        </div>
        <div class="col-sm-2 sidenav">

        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

</body>
</html>