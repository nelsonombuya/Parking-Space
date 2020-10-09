<?php
    // Function for generating the relevant parking query based on user input
    function generateParkingQuery(){
        $chosen_answers = $_SESSION['selection'];
        $parking_location = $chosen_answers[0];

        // Selecting type of parking based on their answer, and priority
        // Handicapped > Pick-Up > Normal Parking
        if ($chosen_answers[2] === "Yes")
        {
            $parking_type = "Handicapped";
        } 
        else if ($chosen_answers[1] === "Less than 30 Minutes")
        {
            $parking_type = "Pick-Up";
        } 
        else 
        {
            $parking_type = "Open";
        }

        // Returning the query
        return  "SELECT P_ID, P_LOCATION FROM PARKING
                WHERE P_TYPE = '$parking_type'
                AND P_STATUS = 'Free'
                AND P_LOCATION = '$parking_location'
                LIMIT 1";
    }

    // Function that checks for available parking spaces
    function checkForParking(){
        // Generating the relevant query according to the driver's needs
        $query = generateParkingQuery();

        // Running the query and getting it's results
        $data_from_db = runQuery($query);

        if (empty($data_from_db))
        {
            // If there are no results, there was no available parking spot that meets the drivers needs
            return suggestParking(FALSE, $data_from_db);
        }
        
        else 
        {
            // If a parking spot was found, that will be the query used to finalize the parking spot booking
            return suggestParking(TRUE, $data_from_db);
        }
    }

    // Function for suggesting the found parking spot to the driver
    function suggestParking($parking_found, $data_from_db){
        // Setting Default questions and answers to be output
        $question = "Confirm Parking Spot";
        $suggestion = "Parking Spot Found At P#";
        $answer = "Confirm";

        if ($parking_found === TRUE)
        {
            // If a parking spot was found
            $parking_location = $data_from_db[0]["P_LOCATION"];
            $parking_id = $data_from_db[0]["P_ID"];
            $suggestion .= $parking_id . " near " . $parking_location;
            $_SESSION['P_ID'] = $parking_id;
        } 
        else 
        {
            // If a parking spot wasn't found, get the closest available parking spot to it
            $selected_location = $_SESSION['selection'][0];
            $result = getNextClosestParking($selected_location);

            if (!empty($result))
            {
                // Another parking spot has been found
                $parking_location = $result[0]["P_LOCATION"];
                $parking_id = $result[0]["P_ID"];
                $suggestion .= $parking_id . " near " . $parking_location;
                $_SESSION['P_ID'] = $parking_id;
            } 
            else 
            {
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

    // Function for getting the closest available parking spot
    function getNextClosestParking($location){
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

    // For booking the parking in the database
    function bookParking(){
        if (isset($_SESSION['username'])){
            $username = $_SESSION['username'];
        } else {
            $username = "guest";
        }
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