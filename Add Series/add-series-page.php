<?php
// Check if user is logged in
if(!isset($_COOKIE["login"])) {
    // Redirect to main page if not logged in
    header('Location: /MainMenu/main-page.php');
    exit;
}
include ('add-series-data.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page title -->
        <title>Add Series</title>
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
        <link rel="stylesheet" href="add-series.css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Include a custom JavaScript file -->
        <script src="add-series.js" type="text/javascript"></script>
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
        <div class="container container-fluid p-4 m-5 shadow space">
            <div class="text-white">
                <!-- Form for adding data to a series -->
                <form action="add-series-data.php" method="POST" autocomplete="off" id="addSeries">

                    <!-- Input field for name of series -->
                    <div class="p-2">
                        <h5>Name: </h5>
                        <input type="text" maxlength="200" class="form-control" name="name" id="name" required>
                        <!-- Display for name error message -->
                        <div id="nameError" class="text-danger"></div>
                    </div>

                    <!-- Input field for author -->
                    <div class="p-2">
                        <h5>Author: </h5>
                        <input type="text" maxlength="200" class="form-control" name="author" id="author">
                    </div>

                    <!-- Select field for status of series -->
                    <div class="p-2">
                        <h5>Status:</h5>
                        <select class="form-control" name="status" id="status">
                            <option value="TBD">TBD</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                            <option value="Hiatus">Hiatus</option>
                        </select>
                    </div>

                    <!-- Input field for latest chapter -->
                    <div class="p-2">
                        <h5>Latest chapter:</h5>
                        <input type="text" maxlength="100" class="form-control" name="lChapter" id="lChapter">
                    </div>

                    <!-- Input field for genres -->
                    <div class="p-2">
                        <h5>Genres: </h5>
                        <input type="text" maxlength="200" class="form-control" name="genre" id="genre">
                    </div>

                    <!-- Input field for image URL -->
                    <div class="p-2">
                        <h5>Image:</h5>
                        <input type="url" maxlength="255" class="form-control" name="image" id="image">
                        <!-- Message about image URL format -->
                        <p><small>The links must end with the image format</small></p>
                    </div>

                    <!-- Textarea for description of series -->
                    <div class="p-2">
                        <h5>Description:</h5> <br>
                        <textarea class="form-control formDescription" maxlength="2500" rows="5" id="textarea" name="description" ></textarea>
                        <!-- Display for character count -->
                        <div class="" id="count">
                            <span id="current">0</span>
                            <span id="maximum">/ 2500</span>
                        </div>
                    </div>

                    <!-- Submit button to send form data to server-side script -->
                    <div class="container-fluid rounded p-3 text-center">
                        <button type="submit" class="button rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>