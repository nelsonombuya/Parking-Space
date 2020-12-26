<?php
    // Includes 
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";
    
    // Getting Parking ID from POST
    $parking_id = htmlentities($_POST['parking-id']);

    // Getting details from the database
    // Checking whether the parking spot exists
    $query =    "SELECT P_ID
                FROM PARKING
                WHERE P_ID = $parking_id";
    if (empty(runQuery($query))) {
        $driver_and_parking_details = FALSE;
    } else {
        $query =    "SELECT DRIVER_ID, USERNAME, DRIVERS.P_ID, TIME_IN, TIME_OUT, P_TYPE, P_STATUS, P_LOCATION
                    FROM DRIVERS, PARKING
                    WHERE DRIVERS.P_ID = PARKING.P_ID 
                    AND DRIVERS.P_ID = '$parking_id'
                    AND TIME_OUT IS NULL";
        $driver_and_parking_details = runQuery($query);
    }
    
    /*
        After getting the details, we display them to the user for them to confirm the spot
        We also show the amount of time they've spent on the spot
    */

    function outputParkingDetails(){
        // Substituting the Global variable for a local one
        $parking_id = $GLOBALS['parking_id'];

        if ($GLOBALS['driver_and_parking_details'] === FALSE){
            // The parking spot doesn't exist
            return array(
                "Question" => "Parking details not found.",
                "Details" => "Parking Spot #$parking_id doesn't exist.",
                "Time" => "Please input a correct Parking Ticket Number",
                "Status" => FALSE,
            );
        } else if (empty($GLOBALS['driver_and_parking_details'])){
            return array(
                "Question" => "The spot is not occupied.",
                "Details" => "Parking Spot #$parking_id isn't occupied.",
                "Time" => "Please input a correct Parking Ticket Number",
                "Status" => FALSE,
            );
        } else {
            // Substituting it for a shorter name
            $details_array = $GLOBALS['driver_and_parking_details'];
            
            // Getting the Parking Spot's details
            $driver_id = $details_array[0]["DRIVER_ID"];
            $username = $details_array[0]["USERNAME"];
            $parking_id = $details_array[0]["P_ID"];
            $parking_location = $details_array[0]["P_LOCATION"];
            
            // Calculating and Formatting Time for Output
            $elapsed_time = time_elapsed_string($details_array[0]["TIME_IN"]);

            // Returning the driver's details for confirmation
            return array(
                "Question" => "Is this your parking spot?",
                "Details" => "Driver #$driver_id ($username) with Parking Spot #$parking_id at $parking_location",
                "Time" => "You parked here $elapsed_time.",
                "Status" => TRUE,
            );
        }
        
    }

    // Calculating elapsed time
    function time_elapsed_string($datetime, $full = true) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    function saveDetailsToSession(){
        $_SESSION['driver_and_parking_details'] = $GLOBALS['driver_and_parking_details'];
    }

    function confirmParkingButtons(){
        if (outputParkingDetails()["Status"] === TRUE){
            return  "<div class='confirm'>".
                        "<input type='submit' value='Confirm'>".
                    "</div>".
                    "<div>".
                        "<a href='javascript:history.back()'><button type='button'>No</button></a>".
                    "</div>";
        } else {
            header("refresh:15; url=Checkout.php");
            return  "<div>".
                        "<a href='javascript:history.back()'><button type='button'>Return</button></a>".
                    "</div>";
                    
        }
    }
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Style.css">
    <title>Confirm Checkout</title>
</head>

<body>
    <div class="container">
        <form name="confirm_checkout_form" onsubmit="<?php saveDetailsToSession(); ?>" action="Finalize Checkout.php" method="post">
            <div class="question">
                <h1><?php echo outputParkingDetails()["Question"]; ?></h1>
            </div>
            <div class="suggestion">
                <h2><?php echo outputParkingDetails()["Details"]; ?></h2>
                <br>
                <em><?php echo outputParkingDetails()["Time"]; ?></em>
                <br>
            </div>
            <div class="selection-box">
                <div class="inputs">
                    <?php echo confirmParkingButtons(); ?>
                </div>
                <div class="buttons">
                </div>
            </div>
        </form>
    </div>
</body>

</html>