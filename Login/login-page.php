<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login/Sign Up Form</title>
        <link rel="icon" href="../images/site-favicon.ico">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="login.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="login.js" type="module"></script>

    </head>
    <body>
        <div class="container container-fluid p-4 m-3 shadow">
            <img src="../images/site-icon.png" alt="icon" class="img-fluid logo">
            <!--The login side of the page-->
            <form action="login.php" method="post" class="form" id="login" name="login"  >
                <h1 class="formTitle text-center m-3 p-2">Login</h1>
                    <div class="formMessage formMessage--Error text-center mb-1"></div>
                <!--Username/Email-->
                    <div class="formInputGroup mb-2">
                        <input type="text" class="formInput" id="username" name="username" autofocus placeholder="Username or Email" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Password-->
                    <div class="formInputGroup mb-2">
                        <input type="password" class="formInput" id="password" name="password" autofocus placeholder="Password" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Submit button-->
                    <button class="formButton" type="submit">Continue</button>
                <!--New Account/Forgot Password-->
                    <p class="formText text-center mt-2">
                        <a href="#" class="formLink">Forgot your password?</a>
                    </p>
                    <p class="formText text-center">
                        <a class="formLink" href="./" id="linkCreateAccount">Don't have an account? Create account</a>
                    </p>
            </form>
            <!--The registration side of the page-->
            <form action="registration.php" method="POST" class="form formHidden" id="createAccount" name="createAccount">
                <h1 class="formTitle text-center m-3 p-2">Create Account</h1>
                    <div class="formMessage formMessage--Error text-center mb-1"></div>
                <!--Username-->
                    <div class="formInputGroup mb-2">
                        <input type="text" id="signupUsername" class="formInput" value="" name="signupUsername" autofocus placeholder="Username" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Email-->
                    <div class="formInputGroup mb-2">
                        <input type="text" id="signupEmail" class="formInput" value="" name="signupEmail" autofocus placeholder="Email Address" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Password-->
                    <div class="formInputGroup mb-2">
                        <input type="password" id="signupPassword" class="formInput" value="" name="signupPassword" autofocus placeholder="Password" required>
                        <span id="strengthDisplay" class="badge displayBadge text-center mt-3">Weak</span>
                     </div>
						<div class ="passwordRequirements text-white mb-2">
                            <ul>
                            <li>The password is at least 8 characters long</li>
                            <li>The password should have one uppercase letter</li>
                            <li>The password should have one lowercase letter</li>
                            <li>The password should have one digit</li>
                            <li>The password should have one special character</li>
                            </ul>
                        </div>
                <!--Confirm Password-->
                    <div class="formInputGroup mb-2">
                        <input type="password" id="signupConfirmPassword" class="formInput" value="" name="signupConfirmPassword" autofocus placeholder="Confirm Password" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Submit button-->
                    <button class="formButton" type="submit">Continue</button>
                <!--Already have account-->
                    <p class="formText text-center mt-2">
                        <a class="formLink" href="./" id="linkLogin">Already have an account? Sign in</a>
                    </p>
            </form>
        </div>
    <div class="errorUsername" id="errorUsername">
        <p>Username already used, please choose another</p>
    </div>
    <div class="errorEmail" id="errorEmail">
        <p>Email already used, please choose another</p>
    </div>
    </body>
</html>