<?php
/*================================== Settings Script ==================================*/
//  Script containing all the pages and settings needed in other pages                 //
/*-------------------------------------------------------------------------------------*/
/*------------------------------------- INCLUDES --------------------------------------*/
    /* 
        FILE PATHS
        ----------
        Script that has a list of all the file path variables used throughout the project
    */
    require_once __DIR__ . '/paths.php';

    /*
        CLASSES
        --------
        Session Class -> Inherits from SQL, which Inherits from Settings 
        Has all the necessary settings and functions we need for any page
    */
    require_once CLASSES . 'session.class.php';
    $Session = new Session;
/*--------------------------------------- Others ---------------------------------------*/
    /* Error reporting. */
    ini_set("error_reporting", "true");
    error_reporting(E_ALL|E_STRCT);
/*-------------------------------------------------------------------------------------*/
?>