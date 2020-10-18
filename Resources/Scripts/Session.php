<?php
/*==================================== SESSION SCRIPT ================================*/
/* Script with commands used to manage the session. Makes Life Easier                */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Parser.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Classes/Session.class.php";
/*====================================================================================*/
    $session = new Session;

    /* Logging out the user when needed */
    if (isset($_GET['logout']) && $_GET['logout'] = TRUE){ 
        $session->logout(); 
    }
?>