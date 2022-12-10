<?php include("profile-data.php");
global $password; global $email; global $username;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="profile.css" type="text/css" />
    <title><?php echo $username?>'s Profile </title>
</head>
<body class ="loggedIn">
<div id="menubar">
    <nav>
        <a href="/MainMenu/main.php">Home</a>
        <a href="#">Browse</a>
        <a href="#">Manga List</a>
        <a href="../Profile/profile.php">Profile</a>
        <div class ="logout">
            <a href="../Login/logout.php">Logout</a>
        </div>
    </nav>
</div>
<div class="data">
    <p>Your account details are below:</p>
    <table>
        <tr>
            <td>Username:</td>
            <td><?php echo $username;?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $email;?></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><?php echo $password;?></td>
        </tr>
    </table>
</div>
</body>
</html>
