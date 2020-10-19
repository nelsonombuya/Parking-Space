<?php
    // Global Data
    $questions_array = [
        // Questions we'll ask the driver
        0 => array(
            "question"  =>  "Where do you want go?",
            "answers"   =>  getLocations()
        ),

        // Whether they're just picking up
        1 => array(
            "question"  =>  "How long will you stay?",
            "answers"   =>  array( "Less than 30 Minutes", "More than 30 Minutes" ),
        ),

        // If they're handicapped
        2 => array(
            "question"  =>  "Do you require Handicapped Parking?",
            "answers"   =>  array( "Yes", "No"),
        ),
    ];
    function getLocations(){
        // Populates the array with list of locations
        $result = runQuery("SELECT DISTINCT P_LOCATION FROM PARKING");
        $counter = 0;
        // Converting the array
        foreach($result as $result) {
            $reduced_array[$counter] = $result["P_LOCATION"];
            $counter++;
        }
        return $reduced_array;
    }

    function initializeGlobals(){
        // Initializing the global variables if they don't exist, and cleaning up previous session
        if (!isset($_SESSION['booked']) || $_SESSION['booked'] === TRUE){
            $_SESSION['booked'] = FALSE;
        }
        if(!isset($_GET['position'])){
            $_GET['position'] = 0;
        }
        if(!isset($_SESSION['selection'])){
            $_SESSION['selection'] = array();

            $counter = 0;
            foreach ($GLOBALS['questions_array'] as $position){
                $_SESSION['selection'][$counter] = "";
                $counter++;
            }
        }
    }
?>