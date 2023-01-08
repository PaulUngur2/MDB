<?php
// Include the main configuration file
require_once("/var/www/MDB/Login/login-config.php");
global $mysqli;

// Check if email and token have been received in the GET request
if (isset($_GET['token'], $_GET['email'])) {
    // Prepare a SELECT query to check if an account with the given email and activation code exists
    if ($stmt = $mysqli->prepare('SELECT * FROM users WHERE email = ? AND activation = ?')) {
        // Bind the email and activation code to the query
        $stmt->bind_param('ss', $_GET['email'], $_GET['token']);
        // Execute the query
        $stmt->execute();
        // Store the result, so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            // Account exists with the requested email and code.
            // Prepare an UPDATE query to set the activation code to 'activated'
            if ($stmt = $mysqli->prepare('UPDATE users SET activation = ? WHERE email = ? AND activation = ?')) {
                // Set the new activation code to 'activated', this is how we can check if the user has activated their account.
                $activated = 'activated';
                // Bind the new activation code and the email and the old activation code to the query
                $stmt->bind_param('sss', $activated, $_GET['email'], $_GET['token']);
                // Execute the query
                $stmt->execute();
                // Redirect to the profile page
                header("Location: /Profile/profile-page.php");
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page title -->
        <title>Activation error</title>
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
        <link rel="stylesheet" href="activate.css" type="text/css">
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <!-- Container for content -->
        <div class="container container-fluid p-4 m-3 shadow">
            <!-- Link to main page -->
            <a class="navbar-brand" href="../MainMenu/main-page.php"> <img src="../images/site-icon.png" alt="logo" class="icon"></a>
            <!-- Display message if the account is already activated or does not exist -->
            <p class="text-white m-5">Something went wrong, the account is already activated or the account doesn't exist.</p>
        </div>
    </body>
</html>
