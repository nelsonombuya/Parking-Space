<?php
/*=================================== Setup Script ====================================*/
//  Script that sets up the system database for the first time                         //
/*-------------------------------------------------------------------------------------*/

/*=====================================Requirements===================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/System/Setup/Setup.class.php";
/*====================================================================================*/
    echo "<pre>";
    print_r($setup = new Setup);
    echo "</pre>";
?>