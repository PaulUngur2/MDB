<?php
// Check if there is a token to access the page
if(!isset($_GET['token'])){
    header('Location: /Login/login-page.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page title -->
        <title>Reset Password</title>
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
        <script src="reset-password.js" type="text/javascript"></script>
    </head>
    <body>
        <!-- HTML form for resetting a user's password -->
        <div class="container container-fluid p-4 m-3 shadow">
            <!-- Form submits to reset-password-data.php -->
            <form action="reset-password-data.php" autocomplete="off" id="resetPassword">
                <!-- Form includes a logo -->
                <a class="navbar-brand" href="../MainMenu/main-page.php"> <img src="../images/site-icon.png" alt="logo" class="icon"></a>
                <h1 class="formTitle text-center m-3 p-2">Reset Password</h1>
                <!-- Input group for email -->
                <div class="formInputGroup mb-2">
                    <input type="email" class="formInput" id="email" name="email" autofocus placeholder="Email" required>
                    <div class="formInputErrorMessage"></div>
                </div>
                <!-- Input group for new password -->
                <div class="formInputGroup mb-2">
                    <input type="password" class="formInput" id="password" name="password" autofocus placeholder="New Password" required>
                    <div class="formInputErrorMessage"></div>
                </div>
                <!-- Input group for confirm password -->
                <div class="formInputGroup mb-2">
                    <input type="password" class="formInput" id="cPassword" name="cPassword" autofocus placeholder="Confirm New Password" required>
                    <div class="formInputErrorMessage"></div>
                </div>
                <button class="formButton" type="submit">Reset Password</button>
                <div class="formSuccessMessage"></div>
                <!-- Form includes a link to the login page -->
                <p class="formText text-center mt-2">
                    <a href="../Login/login-page.php" class="formLink">Go back to Login/Registration</a>
                </p>
                <!-- Form includes a script tag with a PHP token variable -->
                <script>const token = '<?php echo $_GET['token']; ?>';</script>
            </form>
        </div>
    </body>
</html>
