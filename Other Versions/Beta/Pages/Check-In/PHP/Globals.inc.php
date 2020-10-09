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

    // Function for getting the locations registered in the database
    function getLocations(){
        // Populates the array with list of locations
        $result = runQuery("SELECT DISTINCT P_LOCATION FROM PARKING");

        // Reducing the array by one level
        $counter = 0;
        foreach($result as $result) {
            $reduced_array[$counter] = $result["P_LOCATION"];
            $counter++;
        }

        return $reduced_array;
    }

    // Function for initializing and cleaning up the global variables used in the script
    function initializeGlobals(){
        // Variable that set's that the driver has booked a parking spot
        if (!isset($_SESSION['booked']) || $_SESSION['booked'] === TRUE){
            $_SESSION['booked'] = FALSE;
        }

        // Variable used for defining the question that the driver is currently on
        if(!isset($_GET['current_question'])){
            $_GET['current_question'] = 0;
        }

        // Initializing the array used to store the user's answers
        if(!isset($_SESSION['selection'])){
            $_SESSION['selection'] = array();

            $counter = 0;
            foreach ($GLOBALS['questions_array'] as $question){
                $_SESSION['selection'][$counter] = "";
                $counter++;
            }
        }
    }

    // Automatically initializing global variables when this script is included
    initializeGlobals();
?>