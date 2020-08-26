<?php
    // For connecting to the database
    require "../../../../Includes/Configuration/Connection.php";
    require "../../../../Includes/Configuration/Session.php";

    // Getting Parking ID from POST
    $parking_id = htmlentities($_POST['parking-id']);

    // Getting details from the database
    $query =    "SELECT * FROM DRIVERS
                WHERE P_ID = '$parking_id'";
    $result = runQuery($query);

    // -TEST-
    echo "<pre>";
    print_r($result);
    echo "</pre>";