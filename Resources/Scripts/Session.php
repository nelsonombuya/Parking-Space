<?php
    // Driver Details
    // ---------------
    // Function for outputting the current driver number
    function driverNumber(){
        $query =    "SELECT DRIVER_ID FROM DRIVERS 
                    ORDER BY DRIVER_ID DESC
                    LIMIT 1";
        $result = runQuery($query);

        if (is_bool($result)){
            return "No Registered Drivers";
        } else {
            return $result[0]["DRIVER_ID"];
        }
    }
?>