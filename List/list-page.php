<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $_COOKIE["login"]?>'s List</title>
    <link rel="icon" href="../images/site-favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="list.css" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<!--This is for the menu, you can use it to login/sign up or browse the database-->
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
<div class="space">
    <h4 class="texth4 container-fluid col-sm-6 p-3 text-white">Your manga list:</h4>
    <div class="container-fluid col-sm-6">
        <?php  include ('list-data.php'); ?>
    </div>
</div>

</body>
</html>