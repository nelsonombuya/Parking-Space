<?php
/*===================================== Home Page =====================================*/
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    require_once __DIR__ . "/../config/config.php";
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
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- CSS for the big buttons -->
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Redirecting Javacript -->
    <script src="js/index.countdown.js"></script>

    <title>Starting Page</title>
</head>

<body>
    <!-- The Background Wave Layer -->
    <img class="wave" src="img/wave.png" alt="Background">

    <header id=top_header>
        <!-- The Driver's Details Container -->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#<?php echo $Session->current_driver_number; ?></h1>
            </div>
            <div class="user_id">
                <a href="dashboard.php">#<?php echo $Session->username; ?></h2></a>
            </div>
        </div>

        <!-- The Logo Container -->
        <div class="logo">
            <a href="#">
                <img src="img/jeep.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Container-->
        <div class="user">
            <a href="dashboard.php"><img src="img/user.png" alt="User Settings"></a>
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
                <a href="checkin.php">
                    <div class="column">
                        <img src="img/parking.png" alt="Check-In Terminal">
                        <h3>Check-In Terminal</h3>
                    </div>
                </a>
                <a href="checkout.php">
                    <div class="column">
                        <img src="img/checkout.png" alt="Checkout Terminal">
                        <h3>Checkout Terminal</h3>
                    </div>
                </a>
                <a href="dashboard.php">
                    <div class="column">
                        <img src="img/user.png" alt="Account Management">
                        <h3>Account Management</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>