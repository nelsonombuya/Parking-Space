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
        // If there are connection problems using the default settings... 
        // Send the user to the Setup Page
        header("Location: ". HEADER_ROOT . "/setup.php?first_time_setup=TRUE") or die();
    }

    /* Logging out the user when needed */
    if (isset($_GET['logout']) && $_GET['logout'] = TRUE)
    { 
        if (!$Session->logout())
        {
            echo    '<script type="text/JavaScript">  
                        alert("No user is currently logged in."); 
                    </script>';
        } 
    }
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
        href="css/main.css">

    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!--------------------------------------------------------------------------------------------------------------------->

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
                <a href="dashboard.php">
                    <h2>#<?php echo $Session->username; ?></h2>
                </a>
            </div>
        </div>

        <!--The Logo Container-->
        <div class="logo">
            <a href="<?php echo HEADER_ROOT; ?>/">
                <img src="img/lightjeep.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Cog Container-->
        <div class="settings">
            <a href="login.php">
                <img src="img/settings.png" alt="Settings">
            </a>
            <a href="?logout=true">
                <img src="img/logout.png" alt="Logout">
            </a>
        </div>
    </header>
</body>