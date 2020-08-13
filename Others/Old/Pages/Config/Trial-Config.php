<?php
    /*
        Details that will affect the entire MySQL Functionality, and help connect to the server
        Change these according to your database
    */

    //Settings
    /*
        Nelson's Settings
        ******************
        Server      => "localhost"
        Username    => "root"
        Password    => "1234"
        Database    => "Car_Parking_System"
        
    */

    //Use the port that the MySQL Server is set to
    $server_mysql_server = "localhost"; 
    $server_username = "root";
    $server_password = "1234";
    $server_db = "Car_Parking_System";

    //Defining them as constants so as to be able to use them globally within the scripts
    define ('server', $server_mysql_server);  
    define ('server_user', $server_username);
    define ('server_password', $server_password);
    define ('server_db', $server_db);
?>