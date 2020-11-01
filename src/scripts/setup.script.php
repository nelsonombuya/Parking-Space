<?php
/*=================================== Setup Script ====================================*/
//  Script that sets up the system database for the first time                         //
/*-------------------------------------------------------------------------------------*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/../classes/setup.class.php";
/*====================================================================================*/
    /* Acts as the log for the setup script */
    echo "<pre>";
    print_r($Setup = new Setup);
    echo "</pre>";
?>