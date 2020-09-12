<?php
    function parkingQuery(){
        $chosen_answers = $_SESSION['selection'];
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
        return  "SELECT P_ID, P_LOCATION FROM PARKING
                WHERE P_TYPE = '$parking_type'
                AND P_STATUS = 'Free'
                AND P_LOCATION = '$parking_location'
                LIMIT 1";
    }
    // When the answers are input, we check for parking spaces
    function checkForParking(){
        $query = parkingQuery();

        // Runs query and returns answers
        $data_from_db = runQuery($query);

        if (empty($data_from_db)){
            return suggestParking(FALSE, $data_from_db);
        } else {
            $GLOBALS['final_query'] = $query;
            return suggestParking(TRUE, $data_from_db);
        }
    }
    
    function suggestParking($parking_found, $data_from_db){
        // Setting Defaults
        $question = "Confirm Parking Spot";
        $suggestion = "Parking Spot Found At P#";
        $answer = "Confirm";

        // Suggesting the parking spot
        if ($parking_found === TRUE){
            $parking_location = $data_from_db[0]["P_LOCATION"];
            $parking_id = $data_from_db[0]["P_ID"];
            $suggestion .= $parking_id . " near " . $parking_location;
            $_SESSION['P_ID'] = $parking_id;
        } else {
            // Get the next closest parking spot
            $selected_location = $_SESSION['selection'][0];
            $result = nextClosestParking($selected_location);

            if (!empty($result)){
                // Another parking spot has been found
                $parking_location = $result[0]["P_LOCATION"];
                $parking_id = $result[0]["P_ID"];
                $suggestion .= $parking_id . " near " . $parking_location;
                $_SESSION['P_ID'] = $parking_id;
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
        return $result;
    }

    // For booking the parking
    function bookParking(){
        $username = $_SESSION['username'];
        $parking_id = $_SESSION['P_ID'];
        $time_in = date("Y-m-d H:i:s");

        // Query for storing the details in the Drivers Table
        $booking_query =    "INSERT INTO DRIVERS (USERNAME, P_ID, TIME_IN)
                            VALUES ('$username', $parking_id, '$time_in')";

        // The query for updating the Parking Table
        $updating_status_query =    "UPDATE PARKING
                                    SET P_STATUS = 'Taken'
                                    WHERE P_ID = $parking_id";
        
        // Running the Queries
        runQuery($booking_query);
        runQuery($updating_status_query);
    }
?>