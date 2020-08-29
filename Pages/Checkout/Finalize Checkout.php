<?php
    // Includes 
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";
    
    // Getting Parking ID from POST
    $parking_id = htmlentities($_POST['parking-id']);

    // Getting details from the database
    $query =    "SELECT DRIVER_ID, USERNAME, DRIVERS.P_ID, TIME_IN, TIME_OUT, P_TYPE, P_STATUS, P_LOCATION
                FROM DRIVERS, PARKING
                WHERE DRIVERS.P_ID = PARKING.P_ID 
                AND DRIVERS.P_ID = '$parking_id'";
    $driver_and_parking_details = runQuery($query);

    /*
        After getting the details, we display them to the user for them to confirm the spot
        We also show the amount of time they've spent on the spot
    */ 

    function outputParkingDetails(){
        // Substituting it for a shorter name
        $details_array = $GLOBALS['driver_and_parking_details'];

        /*
            NOTE:
            What do we need to do?
            1. Get the driver ID
            2. Get the Spot
            3. Get the Location of the spot
        */
        $driver_id = $details_array[0]["DRIVER_ID"];
        $username = $details_array[0]["USERNAME"];
        $parking_id = $details_array[0]["P_ID"];
        $parking_location = $details_array[0]["P_LOCATION"];

        // Returning the driver's details for confirmation
        return "Driver #$driver_id ($username) with Parking Spot #$parking_id at $parking_location";
        
    }
?>

<head>
    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="Code/Javascript/Checkout Validation.js"></script>

    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Style.css">
    <title>Confirm Checkout</title>
</head>

<body>
    <div class="container">
        <form name="checkout_form" action="Finalize Checkout.php" method="post">
            <div class="question">
                <h1>Is this your parking spot?</h1>
            </div>
            <div class="suggestion">
                <h2><?php echo outputParkingDetails(); ?></h2>
            </div>
            <div class="selection-box">
                <div class="inputs">
                    <div class="confirm">
                        <input type="submit" value="Confirm">
                    </div>
                    <div>
                        <a href="javascript:history.back()"><button type="button">No</button></a>
                    </div>
                </div>
                <div class="buttons">
                </div>
            </div>
        </form>
    </div>
</body>

</html>

<!-- -TEST- For Testing -->
<?php 
    echo "<pre>";
    print_r($driver_and_parking_details);
    echo "</pre>";
?>