<?php
    // Includes 
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";
    // TODO: Release Parking after 20 minutes

    // Now we start the unbooking process
    function checkout(){
        // Making the name a bit shorter
        $details_array = $_SESSION['driver_and_parking_details'];
        $driver_id = $details_array[0]["DRIVER_ID"];
        $parking_id = $details_array[0]["P_ID"];
        $time_out = date("Y-m-d H:i:s");
        /*
            NOTE:
            What do we need to do?
            2. Set the parking spot as free (5 minutes from now?)   TODO:
        */
        // Setting the parking spot as free
        $query =    "UPDATE PARKING
                    SET P_STATUS = 'Free'
                    WHERE P_ID = $parking_id";
        runQuery($query);

        // Updating the Driver's Time Out
        $query =    "UPDATE DRIVERS
                    SET TIME_OUT = '$time_out'
                    WHERE DRIVER_ID = $driver_id";
        runQuery($query);         
    }

    // The Processes to be run during checkout
    checkout();
    unset($_POST);
    unset($_SESSION['driver_and_parking_details']);
    header("refresh:7; url=Checkout.php");

    // // -TEST-
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
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