<?php
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    require_once __DIR__ . "/Settings.inc.php";
/*-------------------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html lang="en">

<!--------------------------------------------------------------------------------------------------------------------->

<head>
    <!-- Stuff To Include -->
    <!-- Monsterrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <!-- From the Pages Folder -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo $Session->version_dir_relative; ?>/Resources/Headers/CSS/Main.css">

    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!--------------------------------------------------------------------------------------------------------------------->

<body>
    <!-- The Background Wave Layer -->
    <img class="wave" src="<?php echo $Session->version_dir_relative; ?>/Resources/Images/Wave.png" alt="Background">
    <header id=top_header>

        <!-- The Driver's Details Container -->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#<?php echo $Session->current_driver_number; ?></h1>
            </div>
            <div class="user_id">
                <a href="<?php echo $Session->version_dir_relative; ?>/Pages/Management/Dashboard.php">
                    <h2>#<?php echo $Session->username; ?></h2>
                </a>
            </div>
        </div>

        <!--The Logo Container-->
        <div class="logo">
            <a href="<?php echo $Session->version_dir_relative; ?>">
                <img src="<?php echo $Session->version_dir_relative; ?>/Resources/Images/Jeep.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Cog Container-->
        <div class="settings">
            <a href="<?php echo $Session->version_dir_relative; ?>/Pages/Login/Login.php">
                <img src="<?php echo $Session->version_dir_relative; ?>/Resources/Images/Settings.png" alt="Settings">
            </a>
            <a href="?logout=true">
                <img src="<?php echo $Session->version_dir_relative; ?>/Resources/Images/Logout.png" alt="Logout">
            </a>
        </div>
    </header>
</body>