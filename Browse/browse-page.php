<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page title -->
        <title>Browse</title>
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
        <link rel="stylesheet" href="browse.css" type="text/css"/>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Include the lazysizes library to delay loading of images -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.8/lazysizes.min.js"></script>
        <!-- Include a custom JavaScript file -->
        <script src="browse.js" type="text/javascript"></script>
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
        <?php
        // Get the value of the 'title' cookie
        $title = $_COOKIE['title'];
        // Expire the 'title' cookie
        setcookie("title", "", time() - 3600, '/');
        ?>
        <div class="space">
            <!-- Display a search box with a default value from the 'title' cookie -->
            <div class="box container-fluid p-3">
                <input type="text" class="form-control" autocomplete="off" id="liveSearch" placeholder="Search titles..." value="<?= $title ?>">
            </div>
            <!-- Display a container element for the search results -->
            <div class="container-fluid" id="searchResult"></div>
        </div>

    </body>
</html>