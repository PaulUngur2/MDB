<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MDB</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE= edge" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="main.css" type="text/css"/>
        <script src="https://kit.fontawesome.com/a288835277.js" crossorigin="anonymous"></script>
    </head>

    <body>
    <!--This is for the menu, you can use it to login/sign up or browse the database-->
    <div id="menubar">
        <nav>
            <a href="/MainMenu/main.php">Home</a>
            <a href="#">Browse</a>
            <?php if(isset($_COOKIE["login"])) { ?>
                <a href="#">Manga List</a>
                <a href="../Profile/profile.php">Profile</a>
                <div class ="logout">
                    <a href="../Login/logout.php">Logout</a>
                </div>
            <?php } else { ?>
                <div class ="LogSig">
                    <a href="../Login/login-page.php">Login/SignUp</a>
                </div>
            <?php } ?>
        </nav>
        </div>
    <!--Title which attracts the attention of the user and the search bar-->
		<div id="title">
		<h1>One of the Biggest Manga Databases</h1>
		</div>
        <div id="container">
            <div class="search">
                <form class="#">
                        <input type="text" placeholder="Search titles" name="search">
                    <button>
                        <i class="fa fa-search"></i>
                    </button>
              </form>
            </div>
        </div>
    </body>
</html>