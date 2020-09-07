<!--First Time Setup-->
<!-- A slimmed version of the hilariously verbose file 😂-->
<?php
    // Files to Include
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/SQL.php";

    // Parsing tables from Tables.ini and using them as a constant
    define('tables', parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Tables.ini", TRUE));

    
    // Function for creating the database
    function createDatabase($database = settings['server']['db']){
        // This will return true if the database is created successfully, and false if not
        return runQuery("CREATE DATABASE " . $database);
    }

    function createTable($table){
        // Used to create a table from it's schema
        return runQuery($table["SCHEMA"]);
    }

    // Creates database according to the one set on Settings.ini (If it doesn't exist)
    if (checkConnection() === "db_error"){
        // checkConnection returning db_error means that the database doesn't exist
        createDatabase();
    }

    // Creating the tables
    foreach (tables as $table => $options){
        createTable($table);
    }
    echo "<pre>";
    print_r(tables);
    echo "</pre>";
?>