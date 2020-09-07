<!--First Time Setup-->
<!-- A slimmed version of the hilariously verbose file 😂-->
<?php
    // Files to Include
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/SQL.php";

    // Parsing tables from Tables.ini and using them as a constant
    define('tables', parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Tables.ini", TRUE));

    // Creates database according to the one set on Settings.ini
    if (checkConnection() === "db_error"){
        // checkConnection returning db_error means that the database doesn't exist
        createDatabase();
    }

    // // Creating the tables
    // foreach (tables as $table => $options){
    //     createTable($options["SCHEMA"]);
    // }
?>