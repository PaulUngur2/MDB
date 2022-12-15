<?php
// Set the expiration date of the cookie to a date in the past
setcookie("userid", "", time() - 3600, '/');
setcookie("login", "", time() - 3600, '/');

// Redirect the user to the login page
header('Location: /MainMenu/main-page.php');
