<!DOCTYPE html>
<html lang="en">
    <head>
        <link href= "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width" inital-scale="1.0"/>
        <meta charset="UTF-8" />
        <title>Login/Sign Up Form</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="container">
            <!--The login side of the page-->
            <form  action="Login.php" method="post" class="form" id="login" name="login"  >
                <h1 class="formTitle">Login</h1>
                    <div class="formMessage formMessage--Error"></div>
                <!--Username/Email-->
                    <div class="formInputGroup">
                        <input type="text" class="formInput" id="username" name="username" autofocus placeholder="Username or Email" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Password-->
                    <div class="formInputGroup">
                        <input type="password" class="formInput" id="password" name="password" autofocus placeholder="Password" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Submit button-->
                    <button class="formButton" type="submit">Continue</button>
                <!--New Account/Forgot Password-->
                    <p class="formText">
                        <a href="#" class="formLink">Forgot your password?</a>
                    </p>
                    <p class="formText">
                        <a class="formLink" href="./" id="linkCreateAccount">Don't have an account? Create account</a>
                    </p>
            </form>
            <!--The registration side of the page-->
            <form action="registration.php" method="POST" class="form formHidden" id="createAccount" name="createAccount">
                <h1 class="formTitle">Create Account</h1>
                    <div class="formMessage formMessage--Error"></div>
                <!--Username-->
                    <div class="formInputGroup">
                        <input type="text" id="signupUsername" class="formInput" value="" name="signupUsername" autofocus placeholder="Username" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Email-->
                    <div class="formInputGroup">
                        <input type="text" id="signupEmail" class="formInput" value="" name="signupEmail" autofocus placeholder="Email Address" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Password-->
                    <div class="formInputGroup">
                        <input type="password" id="signupPassword" class="formInput" value="" name="signupPassword" autofocus placeholder="Password" required>
                        <span id="strengthDisplay" class="badge displayBadge">Weak</span>
                     </div>
						<div class ="passwordRequirements">
                            <li>The password is at least 8 characters long</li>
                            <li>The password should have one uppercase letter</li>
                            <li>The password should have least one lowercase letter</li>
                            <li>The password should have one digit</li>
                            <li>The password has at least one special character</li>
                        </div>
                <!--Confirm Password-->
                    <div class="formInputGroup">
                        <input type="password" id="signupConfirmPassword" class="formInput" value="" name="signupConfirmPassword" autofocus placeholder="Confirm Password" required>
                        <div class="formInputErrorMessage"></div>
                    </div>
                <!--Submit button-->
                    <button class="formButton" type="submit">Continue</button>
                <!--Already have account-->
                    <p class="formText">
                        <a class="formLink" href="./" id="linkLogin">Already have an account? Sign in</a>
                    </p>
            </form>
        </div>
        <script src="login.js" type="module"></script>

    </body>
</html>