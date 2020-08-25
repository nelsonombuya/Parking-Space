<?php
    // When the answers are input, we check for parking spaces
    function checkForParking(){
        $chosen_answers = $_SESSION['selection'];

        // Generating a relevant query
        $parking_location = $chosen_answers[0];

        // Selecting type of parking to give the user according to their answer
        if ($chosen_answers[2] === "Yes"){
            $parking_type = "Handicapped";
        } 
        else if ($chosen_answers[1] === "Less than 30 Minutes"){
            $parking_type = "Pick-Up";
        } 
        else {
            $parking_type = "Open";
        }

        // Returning the query
        $query =    "SELECT P_ID, P_LOCATION FROM PARKING
                    WHERE P_TYPE = '$parking_type'
                    AND P_STATUS = 'Free'
                    AND P_LOCATION = '$parking_location'
                    LIMIT 1";

        // Runs query and returns answers
        $data_from_db = runQuery($query);

        if (empty($data_from_db)){
            return giveParking(FALSE, $data_from_db);
        } else {
            $GLOBALS['final_query'] = $query;
            return giveParking(TRUE, $data_from_db);
        }
    }
    
    function giveParking($parking_found, $data_from_db){
        $question = "Confirm Parking Spot";
        $suggestion = "Parking Spot Found At P#";
        $answer = "Confirm";

        // Suggesting the parking spot
        if ($parking_found === TRUE){
            $parking_location = $data_from_db[0]["P_LOCATION"];
            $parking_id = $data_from_db[0]["P_ID"];
            $suggestion .= $parking_id . " near " . $parking_location;
        } else {
            // Get the next closest parking spot
            $selected_location = $_SESSION['selection'][0];
            $result = nextClosestParking($selected_location);

            if (!empty($result)){
                // Another parking spot has been found
                $parking_location = $result[0]["P_LOCATION"];
                $parking_id = $result[0]["P_ID"];
                $suggestion .= $parking_id . " near " . $parking_location;
            } else {
                // No parking spot has been found
                $question = "There is no available spot.";
                $suggestion = "Try again later.";
                $answer = "Return";
            }
        }

        return array(
            "question" => $question,
            "suggestion" => $suggestion,
            "answers" => $answer,
        );
    }

    function nextClosestParking($location){
        // TODO: Algorithm for the next available parking spot
        // Gives you the nearest parking spot
        $query =   "SELECT P_ID, P_LOCATION FROM PARKING
                    WHERE P_TYPE != 'Reserved'
                    AND P_TYPE != 'Closed'
                    AND P_STATUS = 'Free'
                    LIMIT 1";
        $result = runQuery($query);

        // Saving query as the final query
        if (!empty($result)){
            $GLOBALS['final_query'] = $query;
        }
        return $result;
    }

    // For booking the parking
    function bookParking($query){
        $parking_details = runQuery($query);
        $username = $_SESSION['username'];
        $parking_id = $parking_details[0]["P_ID"];
        $time_in = date("Y-m-d H:i:s");

        // Store these details in the Drivers Table
        $booking_query =    "INSERT INTO DRIVERS (USERNAME, P_ID, TIME_IN)
                            VALUES ('$username', $parking_id, '$time_in')";
        if (runQuery($booking_query) === TRUE){
            $booking = "T";
        } else {
            $booking = "F";
        }

        // We also have to change the status in the main parking table
        $updating_status_query =    "UPDATE PARKING
                                    SET P_STATUS = 'Taken'
                                    WHERE P_ID = $parking_id";
        if (runQuery($updating_status_query) === TRUE){
            $update = "T";
        } else {
            $update = "F";
        }
        
        return $booking.$update;
    }

    // Function for checking errors during booking
    function errorChecker($result){
        // Checks for errors during the booking process
        if ( $result === "TT"){
            $question = "Your Parking Spot Has Been Booked";
            $suggestion = "Have a nice day!";
        } else {
            // If one is F, then there was an error
            $question = "Error booking your parking spot";

            if ($result === "TF"){
                $suggestion = "Error Updating the Parking Status";
            } else if ($result === "FT"){
                $suggestion = "Error Adding the driver's details";
            } else {
                $suggestion = "Error Updating the Parking Status and Adding the Driver's Details";
            }
        }

        return array(
            "question" => $question,
            "suggestion" => $suggestion,
        );
    }
?>