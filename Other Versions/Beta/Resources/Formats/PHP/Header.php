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
    <link rel="stylesheet" type="text/css" href="<?php echo relative_root_dir; ?>/Resources/Formats/CSS/Main.css">
    
    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!--------------------------------------------------------------------------------------------------------------------->

<body>
    <!-- The Background Wave Layer -->
    <img class="wave" src="<?php echo relative_root_dir; ?>/Resources/Images/Wave.png" alt="Background">
    <header id=top_header>

        <!-- The Driver's Details Container -->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#<?php echo $session->driver_number + 1; ?></h1>
            </div>
            <div class="user_id">
                <a href="<?php echo relative_root_dir; ?>/Pages/Management/Dashboard.php">
                    <h2>#<?php echo $session->username; ?></h2>
                </a>
            </div>
        </div>

        <!--The Logo Container-->
        <div class="logo">
            <a href="<?php echo relative_root_dir; ?>/Index.php">
                <img src="<?php echo relative_root_dir; ?>/Resources/Images/Jeep.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Cog Container-->
        <div class="settings">
            <a href="<?php echo relative_root_dir; ?>/Pages/Login/Login.php">
                <img src="<?php echo relative_root_dir; ?>/Resources/Images/Settings.png" alt="Settings">
            </a>
            <a href="?logout=true">
                <img src="<?php echo relative_root_dir; ?>/Resources/Images/Logout.png" alt="Logout">
            </a>
        </div>
    </header>
</body>