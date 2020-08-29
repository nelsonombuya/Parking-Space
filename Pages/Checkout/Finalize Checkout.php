<?php
    // Includes 
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";

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
            1. Set the driver's time out to now
            2. Set the parking spot as free (5 minutes from now?)   TODO:
            3. Redirect to checkout page
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

    // FIXME: Add error handling
    if (isset($_POST['Confirm'])){
        checkout();
        unset($_POST);
        unset($_SESSION['driver_and_parking_details']);
        header("refresh:5; url=Checkout.php");;
    }
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