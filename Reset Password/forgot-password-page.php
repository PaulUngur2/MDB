<?php
// Check if user is logged in
if(isset($_COOKIE["login"])) {
    // Redirect to main page if logged in
    header('Location: /MainMenu/main-page.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page title -->
        <title>Forgot Password</title>
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
        <link rel="stylesheet" href="forgot-password.css" type="text/css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Include a custom JavaScript file -->
        <script src="forgot-password.js" type="text/javascript"></script>
    </head>
    <body>
        <!-- Container for the form -->
        <div class="container container-fluid p-4 m-3 shadow">

            <!-- Form for resetting the password -->
            <form autocomplete="off" id="forgotPassword">

                <!-- Site logo -->
                <a class="navbar-brand" href="../MainMenu/main-page.php"> <img src="../images/site-icon.png" alt="logo" class="icon"></a>

                <!-- Form title -->
                <h1 class="formTitle text-center m-3 p-2">Forgot Password</h1>

                <!-- Input group for email -->
                <div class="formInputGroup mb-2">
                    <input type="email" class="formInput" id="email" name="email" autofocus placeholder="Email" required>
                    <!-- Error message for email input -->
                    <div class="formInputErrorMessage"></div>
                </div>

                <!-- Submit button for resetting password -->
                <button class="formButton" type="submit">Reset Password</button>

                <!-- Success message for password reset -->
                <div class="formSuccessMessage"></div>

                <!-- Link to go back to login/registration page -->
                <p class="formText text-center mt-2">
                    <a href="../Login/login-page.php" class="formLink">Go back to Login/Registration</a>
                </p>
            </form>
        </div>
    </body>
</html>
