<?php
    //Settings for connecting to the database
    /*
        Nelson's Settings
        ******************
        Server      => "localhost"
        Username    => "root"
        Password    => "1234"
        Database    => "Car_Parking_System"
    */

    $server_mysql_server = "localhost";
    $server_username = "root";
    $server_password = "1234";
    $server_db = "Car_Parking_System";

    //I've defined them as constants so that I can use them throughout other scripts
    define ('server', $server_mysql_server);  
    define ('server_user', $server_username);
    define ('server_password', $server_password);
    define ('server_db', $server_db);

    /*  NOTE: 
        Flag for whether to add test data to the database 
        Can be set to FALSE to turn OFF (For a clean database)
        
        FALSE = OFF
        TRUE  = ON

        [Default is TRUE => ON]
    */
    $add_test_data = TRUE;
?>