<?php   
    // // Includes 
    // require "Includes/Configuration/Session.php";
    // Files to be included 
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Includes.php";

    /*
    TODO: 
    We're currently implementing changes to the Front-End
    Thank you Benji 👌️ 
    NOTE: This is the old index page that I had designed
    */
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
    <link rel="stylesheet" type="text/css" href="Resources/Formats/CSS/Main.css">
    <!-- CSS for the big buttons -->
    <link rel="stylesheet" type="text/css" href="Pages/Index/CSS/Index.css">

    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Redirecting Javacript -->
    <script src="Pages/Index/Javascript/Countdown.js"></script>

    <title>Starting Page</title>
</head>

<body>
    <!-- The Background Wave Layer -->
    <img class="wave" src="Resources\Images\Wave.png" alt="Background">

    <header id=top_header>
        <!-- The Driver's Details Container -->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#<?php echo (driverNumber() + 1); ?></h1>
            </div>
            <div class="user_id">
                <a href="Pages\Management\Account.php">#<?php // TODO: echo $_SESSION['username'];?></h2></a>
            </div>
        </div>

        <!-- The Logo Container -->
        <div class="logo">
            <a href="index.php">
                <img src="Resources\Images\Jeep.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Container-->
        <div class="user">
            <img src="Resources\Images\User.png" alt="User Settings">
            <!-- TODO: Create a menu under the profile icon -->
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
                <a href="Pages/Check-In/Check-In.php">
                    <div class="column">
                        <img src="Resources\Images\Parking.png" alt="Check-In Terminal">
                        <h3>Parking Terminal</h3>
                    </div>
                </a>
                <a href="Pages/Checkout/Checkout.php">
                    <div class="column">
                        <img src="Resources\Images\Checkout.png" alt="Checkout Terminal">
                        <h3>Check Out Terminal</h3>
                    </div>
                </a>
                <a href="Pages\Login\Login.php">
                    <div class="column">
                        <img src="Resources\Images\User.png" alt="Account Management">
                        <h3>Account Management</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>