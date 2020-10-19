<?php
/*================================== Settings Script ==================================*/
//  Script containing all the pages needed in other pages                              //
/*-------------------------------------------------------------------------------------*/

/*------------------------------------- INCLUDES --------------------------------------*/
    /* CLASSES */
    /* Database */
    require_once $_SERVER['DOCUMENT_ROOT'] . "/System/Session/Session.class.php";
    $Session = new Session;
    
    /* EXTERNAL CLASSES AND SCRIPTS */
    require_once $Session->version_dir . "/Resources/Scripts/External.inc.php";
/*-------------------------------------------------------------------------------------*/

    /* Checking if the connection to the server is made */
    if ($Session->checkConnection() !== TRUE)
    {
        // If there are connection problems using the default settings... 
        // Send the user to the Setup Page
        header("Location: /System/Setup/Setup.php") or die();
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
?>