<?php   // Includes 
    include "Includes/Code/Page Formats/Head.php";
    //Naming the page
    $_SESSION['page_title'] = "Car Parking System - Terminal";
?>
<head>
    <!--Main CSS File-->
    <link rel="stylesheet" type="text/css" href="Includes/Code/CSS/Main Style.css">
    <!--CSS for the big buttons-->
    <link rel="stylesheet" type="text/css" href="Pages\Terminal\Code\CSS\Style.css">
</head>
<body>
    <!--Previous Elements-->
    <!--The Background Wave Layer-->
	<img class="wave" src="Includes\Media\Images\Wave.png" alt="Background">
    <header id=top_header>
        <!--The Driver's Details Container-->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#Driver ID</h1>
            </div>
            <div class="user_id">
                <h2>#<?php echo $_SESSION['username'];?></h2>
            </div>
        </div>

        <!--The Logo Container-->
        <div class="logo">
            <img src="Includes\Media\Images\Logo.png" alt="Logo">
        </div>

        <!--The Settings Cog Container-->
        <div class="settings">
            <a href="Pages\Login\Login.html"><img src="Includes\Media\Images\Settings.png" alt="Settings"></a>
        </div>
    </header>

    <!-- Proceed with the Rest of the Body Container -->
    <div class="container">
        <div class="question">
            <h1>Dynamic Questions</h1>
        </div>
        <div class="options">
            <strong><h2>Dynamic Buttons</h2></strong>
            <div class="option_buttons">
                
            </div>
        </div>
    </div>
</body>
</html>