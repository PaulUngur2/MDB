<?php include("profile-data.php");
global $email, $username, $token, $activation;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Page title -->
        <title><?= $_COOKIE["login"]?>'s Profile </title>
        <link rel="icon" href="../images/site-favicon.ico">
        <!-- Favicon -->
        <link rel="icon" href="../images/site-favicon.ico">
        <!-- Character encoding -->
        <meta charset="utf-8">
        <!-- Viewport for responsive design -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <!-- Bootstrap icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <!-- Page-specific CSS -->
        <link rel="stylesheet" href="profile.css" type="text/css" />
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Include a custom JavaScript file -->
        <script src="activate.js" type="text/javascript"></script>
    </head>

    <body>
        <!-- Navigation bar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <!-- Container for navbar elements -->
            <div class="container-fluid">
                <!-- Site logo -->
                <a class="navbar-brand" href="../MainMenu/main-page.php"> <img src="../images/site-icon.png" alt="logo" class="icon" defer></a>
                <!-- Toggle button for collapsed navbar on small screens -->
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar links -->
                <div id="mynavbar" class="navbar-collapse collapse">
                    <ul class="navbar-nav me-auto">
                        <!-- Home link -->
                        <li class="nav-item">
                            <a class="nav-link" href="../MainMenu/main-page.php">Home</a>
                        </li>
                        <!-- Browse link -->
                        <li class="nav-item">
                            <a class="nav-link" href="../Browse/browse-page.php">Browse</a>
                        </li>
                        <!-- Conditional links for logged in users -->
                        <?php if(isset($_COOKIE["login"])) { ?>
                            <!-- Manga list link -->
                            <li class="nav-item">
                                <a class="nav-link" href="../List/list-page.php">Manga List</a>
                            </li>
                            <!-- Profile link -->
                            <li class="nav-item">
                                <a class="nav-link" href="../Profile/profile-page.php">Profile</a>
                            </li>
                            <!-- Add series link -->
                            <li class="nav-item">
                                <a class="nav-link" href="../Add%20Series/add-series-page.php">Add Series</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- Links for login and logout -->
                    <ul class="navbar-nav navbar-right">
                        <!-- Conditional login link for logged out users -->
                        <?php if(!isset($_COOKIE["login"])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../Login/login-page.php"><span class="bi bi-box-arrow-in-right"></span> Login/SignUp</a>
                            </li>
                        <?php } else { ?>
                            <!-- Logout link for logged in users -->
                            <li class="nav-item">
                                <a class="nav-link" href="../Login/logout.php"><span class="bi bi-box-arrow-left"></span> Logout</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main content -->
        <div class="space">
            <!-- Display header text -->
            <h4 class="texth4 container-fluid col-sm-6 p-3 text-white">Your account details are below:</h4>
            <!-- Container for table -->
            <div class="box container-fluid table-responsive col-sm-6" >
                <!-- Table for displaying account details -->
                <table class="table text-white">
                    <!-- Table head for username -->
                    <thead>
                        <tr>
                            <th>Username:</th>
                            <!-- Display the username -->
                            <td><?= $username ?></td>
                        </tr>
                    </thead>
                    <!-- Table head for email -->
                    <thead>
                        <tr>
                            <th>Email:</th>
                            <!-- Display the email -->
                            <td><?= $email ?></td>
                        </tr>
                    </thead>
                    <!-- Table head for password -->
                    <thead>
                        <tr>
                            <th>Password:</th>
                            <!-- Link to reset password page, passing the email in a script tag -->
                            <td><a href="" class="link" id="resetProfile">Reset Password<script> let email = <?= json_encode($email) ?></script></a></td>
                        </tr>
                    </thead>
                    <!-- Table head for activation status -->
                    <thead>
                        <tr>
                            <th>Activation Status:</th>
                            <!-- Display the activation status -->
                            <td> <?= $activation ?></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </body>
</html>
