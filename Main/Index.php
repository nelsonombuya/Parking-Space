<?php
/*===================================== Home Page =====================================*/
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/System/Session/Session.class.php";
    $Session = new Session;
/*-------------------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Stuff To Include -->
    <!-- Fonts -->
    <!-- Monsterrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <!-- From the Includes Folder -->
    <link rel="stylesheet" type="text/css" href="Resources/Headers/CSS/Main.css">
    <!-- CSS for the big buttons -->
    <link rel="stylesheet" type="text/css" href="Index/CSS/Index.css">

    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Redirecting Javacript -->
    <script src="Index/JS/Countdown.js"></script>

    <title>Starting Page</title>
</head>

<body>
    <!-- The Background Wave Layer -->
    <img class="wave" src="Resources/Images/Wave.png" alt="Background">

    <header id=top_header>
        <!-- The Driver's Details Container -->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#<?php echo $Session->current_driver_number; ?></h1>
            </div>
            <div class="user_id">
                <a href="Management/Account.php">#<?php echo $Session->username; ?></h2></a>
            </div>
        </div>

        <!-- The Logo Container -->
        <div class="logo">
            <a href="Index.php">
                <img src="Resources/Images/Jeep.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Container-->
        <div class="user">
            <img src="Resources/Images/User.png" alt="User Settings">
            <!-- TODO: Create a menu under the profile icon, include the user's photo-->
            <!-- NOTE: Make it include the Log In, Sign Up, Settings, Profile, Log Out in a context intelligent manner -->
        </div>
    </header>

    <div class="container">
        <div class="title">
            <h1>Car Parking System</h1>
        </div>
        <div class="question">
            <h2>Would you like to open the terminal, or manage your account?</h2>
        </div>
        <div class="options">
            <div class="emphasis">
                <em id="emphasis">This page will automatically redirect to the <strong>Check-In Terminal</strong> in:
                    <strong id="countdown">30 seconds.</strong></em>
            </div>
            <div class="row">
                <a href="Check-In/Check-In.php">
                    <div class="column">
                        <img src="Resources/Images/Parking.png" alt="Check-In Terminal">
                        <h3>Check-In Terminal</h3>
                    </div>
                </a>
                <a href="Checkout/Checkout.php">
                    <div class="column">
                        <img src="Resources/Images/Checkout.png" alt="Checkout Terminal">
                        <h3>Checkout Terminal</h3>
                    </div>
                </a>
                <a href="Login/Login.php">
                    <div class="column">
                        <img src="Resources/Images/User.png" alt="Account Management">
                        <h3>Account Management</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>