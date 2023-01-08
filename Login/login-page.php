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
        <title>Login/Sign Up Form</title>
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
        <link rel="stylesheet" href="login.css" type="text/css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Include a custom JavaScript file -->
        <script src="login.js" type="module"></script>

    </head>
    <body>
        <!-- Container for the login form -->
        <div class="container container-fluid p-4 m-3 shadow">
            <!-- Site logo -->
            <a class="navbar-brand" href="../MainMenu/main-page.php"> <img src="../images/site-icon.png" alt="logo" class="icon"></a>
            <!-- Login Form -->
            <form action="login.php" method="post" class="form" id="login" name="login" autocomplete="off">
                <!-- Form Title -->
                <h1 class="formTitle text-center m-3 p-2">Login</h1>
                <!--Username/Email Input Field-->
                <div class="formInputGroup mb-2">
                    <input type="text" class="formInput" id="username" name="username" autofocus placeholder="Username or Email" required>
                    <!-- Display error message -->
                    <div class="formInputErrorMessage"></div>
                </div>
                <!--Password Input Field-->
                <div class="formInputGroup mb-2">
                    <input type="password" class="formInput" id="password" name="password" autofocus placeholder="Password" required>
                    <!-- Display error message -->
                    <div class="formInputErrorMessage"></div>
                </div>
                <!--Submit Button-->
                <button class="formButton" type="submit">Continue</button>
                <!--Forgot Password Link-->
                <p class="formText text-center mt-2">
                    <a href="../Reset%20Passoword/forgot-password-page.php" class="formLink">Forgot your password?</a>
                </p>
                <!--Create Account Link-->
                <p class="formText text-center">
                    <a class="formLink" href="./" id="linkCreateAccount">Don't have an account? Create account</a>
                </p>
            </form>
            <!--The registration side of the page-->
            <form action="registration.php" method="POST" class="form formHidden" id="createAccount" name="createAccount" autocomplete="off">
                <h1 class="formTitle text-center m-3 p-2">Create Account</h1>
                    <div class="formMessage formMessage--Error text-center mb-1"></div>
                <!--Username Input Field-->
                    <div class="formInputGroup mb-2">
                        <input type="text" id="signupUsername" class="formInput" value="" name="signupUsername" autofocus placeholder="Username" required>
                        <!-- Display error message -->
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Email Input Field-->
                    <div class="formInputGroup mb-2">
                        <input type="email" id="signupEmail" class="formInput" value="" name="signupEmail" autofocus placeholder="Email Address" required>
                        <!-- Display error message -->
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!-- Password Input Field -->
                <div class="formInputGroup mb-2">
                    <input type="password" id="signupPassword" class="formInput" value="" name="signupPassword" autofocus placeholder="Password" required>
                    <!-- Display the password strength badge -->
                    <span id="strengthDisplay" class="badge displayBadge text-center mt-3">Weak</span>
                </div>
                <!-- Password Requirements List -->
                <div class ="passwordRequirements text-white mb-2">
                    <ul>
                        <li>The password is at least 8 characters long</li>
                        <li>The password should have one uppercase letter</li>
                        <li>The password should have one lowercase letter</li>
                        <li>The password should have one digit</li>
                        <li>The password should have one special character</li>
                    </ul>
                </div>
                <!-- Confirm Password Input Field -->
                <div class="formInputGroup mb-2">
                    <input type="password" id="signupConfirmPassword" class="formInput" value="" name="signupConfirmPassword" autofocus placeholder="Confirm Password" required>
                    <!-- Display error message if password and confirm password do not match -->
                    <div class="formInputErrorMessage"></div>
                </div>
                <!-- Submit Button -->
                <button class="formButton" type="submit">Continue</button>
                <!-- Display success message upon successful form submission -->
                <div class="formSuccessMessage"></div>
                <!-- Link to login page for users who already have an account -->
                    <p class="formText text-center mt-2">
                        <a class="formLink" href="./" id="linkLogin">Already have an account? Sign in</a>
                    </p>
            </form>
        </div>
    </body>
</html>