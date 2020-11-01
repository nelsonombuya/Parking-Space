<?php
/*=====================================================================================*/
//  Welcome to Parking Space!                                                          //
//  This page is Used to redirect the user to the set system version.                  //
//  You will be redirected shortly.                                                    //
/*-------------------------------------------------------------------------------------*/

/*----------------------------------- REQUIREMENTS ------------------------------------*/
    require_once __DIR__ . "/System/Database/SQL.class.php";
    $SQL = new SQL;
/*-------------------------------------------------------------------------------------*/
    /* Checking if the connection to the server is made */
    if ($SQL->checkConnection() !== TRUE)
    {
        // If there are connection problems using the default settings... 
        // Send the user to the Setup Page
        header("Location: System/Setup/Setup.php") or die();
    }
    else
    {
        header("Location: ". $SQL->version_dir_relative) or die();
    }
?>