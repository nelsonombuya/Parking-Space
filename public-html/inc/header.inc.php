<?php
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    /* Adding the config file */
    require_once __DIR__ . "/../../config/config.php";

    /* 
        These are the scripts run on any page. 
        They assist in Logging Out and The first time setup of the System 
    */
    /* Checking if the connection to the server is made */
    if ($Session->connection_status !== "sql_connected_db")
    {
        /* 
            If there are connection problems using the default settings... 
            Send the user to the Setup Page
        */
        header("Location: ". HEADER_ROOT . "/setup.php?state=new") or die();
    }

    /* Logging out the user when needed */
    if (isset($_GET['logout'])) isset($_GET['logout_confirmed']) ? $Session->logout(TRUE) : $Session->logout();

    /* Provides a set of context sensitive Login and Logout Buttons */
    function dynamicLoginButtons()
    {
        if (isset($_SESSION['username']))
        {
            if (basename($_SERVER['PHP_SELF']) === "dashboard.php")
            {
                return "<a class='nav-item nav-link' href='?logout=true'>Logout</a>";
            }
            else
            {
                return "<a class='nav-item nav-link' href='dashboard.php'>". $_SESSION['username'] . "</a>".
                "<a class='nav-item nav-link' href='?logout=true'>Logout</a>";
            }
        }
        else if (basename($_SERVER['PHP_SELF']) !== "login.php")
        {
            return "<a class='nav-item nav-link' href='login.php'>Login</a>";
        }
    }
/*-------------------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <!--Icon for Title-->
    <link rel="icon" href="img/lightjeep.png" type="image/icon type">
</head>

<body>
    <header>
        <!--Navbar Section-->
        <nav class="navbar navbar-expand-md navbar-dark sticky-top ">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="img/lightjeep.png" width="25" height="25" alt="logo">
                </a>
                <a class="navbar-brand" href="index.php">Parking Space</a>
                <a class="navbar-brand" href="reports.php?drivers=all">#<?php echo $Session->current_driver_number; ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link" href="index.php">Home </a>
                        <a class="nav-item nav-link" href="#about">About</a>
                        <a class="nav-item nav-link" href="#FAQ">FAQ</a>
                        <a class="nav-item nav-link" href="#contacts">Contacts</a>
                        <?php echo dynamicLoginButtons(); ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</body>