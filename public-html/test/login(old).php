<?php
/*==================================== Login Page =====================================*/
/*---------------------------------- Required Files -----------------------------------*/
    require_once __DIR__ . "/../config/config.inc.php";
    require_once SCRIPTS . "errors.script.php";
/*-------------------------------------------------------------------------------------*/

    /* Checks if a login error has happened, if not, just run the main script */
    if (isset($_GET['error']))
    {
        echo checkLoginErrors($_GET['error']);
        
        /* Unsets the error after the error message has been shown */
        unset($_GET['error']);
    }

    // If the user is already logged in, redirect to account settings
    if (isset($_SESSION['username'])) header("Location: " . HEADER_ROOT . "dashboard.php") or die();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="js/login.validation.js"></script>

    <!-- Monsterrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/login.css" />

    <!-- Javascript (From Fontawesome) [Has the Username And Password Icons] -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!-- Page Metadata -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <!-- The Background Wave Layer -->
    <img class="wave" src="img/wave.png" />

    <!-- The Page Content Container -->
    <div class="container">
        <!-- Image on top of the wave layer -->
        <div class="img">
            <img src="img/authentication.svg" />
        </div>
        <!--The Login Box-->
        <div class="login-content">
            <form name="login_form" onsubmit="return login_validation();" action="inc/login.inc.php"
                method="POST">
                <img src="img/avatar.svg" />
                <h2 class="title">Account</h2>

                <!-- Username or Email -->
                <div class="input-div username">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username/Email</h5>
                        <input type="text" name="login_username" class="input" />
                    </div>
                </div>

                <!-- Password -->
                <div class="input-div password">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="login_password" class="input" />
                    </div>
                </div>
                <a href="#">Forgot Password?</a>
                <!-- TODO: Come back here to link to the password recovery page -->
                <input type="submit" class="btn" value="Sign In" />
                <a href="index.php"><button type="button" class="btn" value="Guest">Continue as Guest</button></a>
            </form>
        </div>
    </div>

    <!-- Transitions Javascript-->
    <script type="text/javascript" src="js/login.transitions.js"></script>
</body>

</html>