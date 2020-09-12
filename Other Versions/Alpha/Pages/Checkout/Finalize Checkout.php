<?php
    // Includes 
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";
    require "Code/PHP/Release Parking.php";

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
        $query =    "UPDATE DRIVERS
                    SET TIME_OUT = '$time_out'
                    WHERE DRIVER_ID = $driver_id";
        runQuery($query);         
    }

    // The Processes to be run during checkout
    checkout();
    header("refresh:7; url=Checkout.php");
?>

<head>
    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="Code/Javascript/Checkout Validation.js"></script>

    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Style.css">
    <title>Finalized Checkout</title>
</head>

<body>
    <div class="container">
        <div class="question">
            <h1>Checkout Successful</h1>
        </div>
        <div class="suggestion">
            <h2>You may leave your parking spot in the next 20 minutes.</h2>
        </div>
    </div>
</body>

</html>