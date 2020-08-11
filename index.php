<?php   // Includes 
    include "Includes/Code/Page Formats/Head.php";
?>
<head>
    <!--Main CSS File-->
    <link rel="stylesheet" type="text/css" href="Includes/Code/CSS/Main Style.css">
    
    <!--CSS for the big buttons-->
    <link rel="stylesheet" type="text/css" href="Pages/Terminal/Code/CSS/Style.css">

    <title>Car Parking System - Terminal</title>
</head>
<body>
    <!--The Background Wave Layer-->
    <img class="wave" src="Includes\Media\Images\Wave.png" alt="Background">
    
    <header id=top_header>
        <!--The Driver's Details Container-->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#<?php echo session_outputs('username');?></h1> <!--TODO: Add the driver's number-->
            </div>
            <div class="user_id">
            <a href="Pages\Management\Account Management.php"><h2><?php echo session_outputs('username');?></h2></a>
            </div>
        </div>

        <!--The Logo Container-->
        <div class="logo">
            <a href="index.php">
                <img src="Includes\Media\Images\Logo.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Cog Container-->
        <div class="settings">
            <a href="Pages\Login\Login.html"><img src="Includes\Media\Images\Settings.png" alt="Settings"></a>
        </div>
    </header>

    <div class="container">
        <div class="question">
            <h1>Welcome to Bueno Mall</h1>
        </div>
    </div>
</body>
</html>