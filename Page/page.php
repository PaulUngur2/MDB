<?php include("page-data.php");
global $name, $lchapter, $genre, $status, $rating, $img, $description, $added, $userRating, $author;
// Add space after each , in genre
$genre = preg_replace('/,/', ', ', $genre);

if(!isset($_GET['id'])) {
    // Redirect to main page if there is no id
    header('Location: /MainMenu/main-page.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Page title -->
        <title><?php echo $name ?></title>
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
        <link rel="stylesheet" href="page.css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Include a custom JavaScript file -->
        <script src="page.js" type="text/javascript"></script>
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
        <div class="container-fluid pt-1">
            <!-- Start of main content container -->
            <div class="row content">
                <!-- Start of left sidebar -->
                <div class="col-sm-2 sidenav">
                    <!-- Display manga cover image -->
                    <div class="text-center">
                        <img src="<?= $img ?>" class="img-fluid mb-4 rounded shadow imgSize" alt="Responsive image">
                    </div>
                    <!-- Display add to list form if the user is logged in -->
                    <?php if(isset($_COOKIE["login"])) { ?>
                        <form action="page-add.php" class="text-center" method="post" id="pageAdd" name="pageAdd">
                            <!-- Pass manga ID as a hidden field -->
                            <input type="hidden" name="mangaId" id="mangaId" value="<?= $_GET['id'] ?>">
                            <!-- Display add/remove button -->
                            <button type="submit" class="btn btn-block mb-3 ps-xxl-5 pe-xxl-5 button border-0"> <?= $added ?></button>
                        </form>
                    <?php } ?>
                    <!-- Display manga information in a box -->
                    <div class="box container-fluid rounded p-3 mt-5">
                        <h5>Author: <?= $author ?></h5>
                        <h5>Latest chapter: <?= $lchapter ?></h5>
                        <h5>Status: <?= $status ?></h5>
                        <h5>Rating: <?= $rating ?>/5</h5>
                        <!-- Display rating select if the user has added the manga to their list and if you are logged in-->
                        <?php if(isset($_COOKIE["login"])) { ?>
                            <?php if ($added == "Added"){
                                // Show the rating select
                                echo '<style> .yourRating {display: block;} </style>';
                                ?>
                                <div class="form-inline yourRating">
                                    <div class="form-group">
                                        <!-- Display rating options -->
                                        <select class="form-control form-control-sm" id="ratingSelect">
                                            <option value="0" <?= $userRating == 0 ? 'selected' : '' ?>>Your Rating: 0/5</option>
                                            <option value="1" <?= $userRating == 1 ? 'selected' : '' ?>>Your Rating: 1/5</option>
                                            <option value="2" <?= $userRating == 2 ? 'selected' : '' ?>>Your Rating: 2/5</option>
                                            <option value="3" <?= $userRating == 3 ? 'selected' : '' ?>>Your Rating: 3/5</option>
                                            <option value="4" <?= $userRating == 4 ? 'selected' : '' ?>>Your Rating: 4/5</option>
                                            <option value="5" <?= $userRating == 5 ? 'selected' : '' ?>>Your Rating: 5/5</option>
                                            <!-- Pass manga ID as a hidden field -->
                                            <script> let id = <?= $_GET['id'] ?> </script>
                                            </select>
                                        </div>
                                    </div>
                            <?php }
                        } ?>
                    </div>
                </div>
                <!-- Container for the manga's title and genre information, as well as the manga's description -->
                <div class="col-sm-8 text-left">
                    <div class="box container-fluid rounded p-3 mt-5">
                        <!-- Title of the manga -->
                        <h4><?= $name ?></h4>
                        <!-- Genres of the manga -->
                        <p class="lead"><small>Genres: <?= $genre ?></small></p>
                    </div>
                    <!-- Container for the manga's description -->
                    <div class="box container-fluid align-content-lg-start rounded p-3 mt-5">
                        <h5>Description:</h5>
                        <!-- Description of the manga -->
                        <p class="lead"> <?= $description ?> </p>
                    </div>
                </div>

                <!-- Container for links to external websites, such as Amazon and Barnes & Noble -->
                <div class="col-sm-2 sidenav">
                    <!-- Button for editing the manga's page, only visible if the user has a login cookie -->
                    <?php if(isset($_COOKIE["login"])) { ?>
                        <div class="box container-fluid rounded p-3 mt-5">
                        <a href="../Page%20Edit/page-edit.php?id=<?= $_GET['id'] ?>&name=<?= $name ?>&status=<?= $status ?>" class="link"><h4 class="text-white">Edit Page</h4></a>
                    </div>
                    <?php } ?>
                    <!-- Container for links to external websites where the link is updated based on the name of the series-->
                    <div class="box container-fluid rounded p-3 mt-5">
                        <a  href="https://www.amazon.com/s?k=<?= urldecode($name) ?>&i=stripbooks&ref=nb_sb_noss" class="link"><span class="bi bi-bag"></span> Amazon</a>
                    </div>
                    <div class="box container-fluid rounded p-3 mt-2">
                        <a  href="https://www.barnesandnoble.com/s?store=book&keyword=<?= urldecode($name) ?>" class="link"><span class="bi bi-bag"></span> Barnes & Noble</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>