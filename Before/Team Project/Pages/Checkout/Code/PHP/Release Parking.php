<?php
    function releaseParking($parking_id, $time_out){
        $query =    "UPDATE PARKING
                    SET P_STATUS = 'Free'
                    WHERE P_ID = $parking_id";
        runQuery($query);
        unset($_POST);
        unset($_SESSION['driver_and_parking_details']);
    }
    /* TODO: 
        This is a function that releases a parking spot after 20 minutes (For testing, we'll use 30 seconds to 1 minute)
        We'll use a server array to store the parking ID and time_out
        We'll set these details in a queue if possible
        Then set the function to run periodically (every minute)
        It checks the time out for each parking added to the array, then if the time out has been passed
        If so, it adds it to another array
        The parking IDs in the array are then released on the SQL table
        Then released from the server array, and the array is resorted
        It should also add values to the  end of the array
    */ 
?>