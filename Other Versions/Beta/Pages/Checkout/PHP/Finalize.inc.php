<?php
    // Now we start the unbooking process
    function checkout(){
        // Making the name a bit shorter
        $details_array = $_SESSION['driver_and_parking_details'];
        $driver_id = $details_array[0]["DRIVER_ID"];
        $parking_id = $details_array[0]["P_ID"];
        $time_out = date("Y-m-d H:i:s");

        // Setting the parking spot as free
        releaseParking($parking_id, $time_out);

        // Updating the Driver's Time Out
        // NOTE: We can use normal sql statements since the data is directly from the DB
        $query =    "UPDATE BOOKINGS
                    SET TIME_OUT = '$time_out'
                    WHERE DRIVER_ID = $driver_id";
        runQuery($query);         
    }

    function releaseParking($parking_id, $time_out){
        // Using Prepared Statements to avoid SQL injections
        // Checking for connection to DB
        $connection_status = checkConnection();

        if ($connection_status !== TRUE)
        {
            // If there's a connection error
            header("Location: Checkout.php?checkout_error=$connection_status") or die();
        } 
        else 
        {
            // Connecting to the database
            $conn = connectToDatabase();

            //The query for updating the parking details in the database
            $query =    "UPDATE PARKING SET P_STATUS = 'Free' WHERE P_ID = ?";
        
            // Preparing and executing the query
            if (!$stmt =  $conn->stmt_init())
            {
                // Error initializing the SQL Statement
                header("Location: Checkout.php?checkout_error=sql_init") or die();
                return FALSE;
            }

            else if (!$stmt = $conn->prepare($query))
            {
                // Error preparing the SQL Statement
                header("Location: Checkout.php?checkout_error=sql_prepare") or die();
                return FALSE;
            }
            
            else if (!$stmt->bind_param("i", $parking_id))
            {
                // Error binding parameters
                header("Location: Checkout.php?checkout_error=sql_bind") or die();
                return FALSE;
            }
            
            else if (!$stmt->execute())
            {
                // Execute query
                header("Location: Checkout.php?checkout_error=sql_execute") or die();
                return FALSE;
            }
            
            else
            {
                
                return TRUE;
            }
        }

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

    // The Processes to be run during checkout
    checkout();
    header("refresh:7; url=Checkout.php");
?>