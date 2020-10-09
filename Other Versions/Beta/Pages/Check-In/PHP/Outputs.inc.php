<?php
    // Checking for parking spots at the relevant time
    if ($_GET['current_question'] == 3){
        $checkForParking_results = checkForParking();
    }

    // Function that prints the current question from the specified position in the array
    function printQuestion($position){
        if ($position <= 2)
        {
            // The first questions get the driver's needs
            echo $GLOBALS['questions_array'][$position]['question'];
        } 
        else if ($_GET['current_question'] < 4)
        {
            // The driver has specified his needs and now we check for the available parking spot
            // NOTE: If no parking spot was found, the driver's transaction will end here
            echo $GLOBALS['checkForParking_results']['question'];
        } 
        else 
        {
            // The driver has successfully booked a parking spot
            echo "Parking has been booked successfully.";
        }
    }

    // Function that prints the answers relevant to the questions selected by the driver
    function printAnswers($position){
        // First, we get the answers from the questions_array and then print each answer
        if ($position <= 2)
        {
            // The answers to the first questions that ask for the driver's needs
            foreach ($GLOBALS['questions_array'][$position]['answers'] as $answers_array => $answer){
                echo    "<div class='option'>".
                            "<a href='?current_question=".($position + 1)."&selection=".$answer."'>".$answer."</a>".
                        "</div>";
            }
        } 
        
        // Answers after the user has selected their needs
        else if ($position < 4) 
        {
            // The answers that depend on the available parking spots
            $answer = $GLOBALS['checkForParking_results']['answers'];
            if ($answer !== "Confirm")
            {
                /* 
                    If the answer provided by the suggestParking function is not "Confirm"...
                    It means that no parking spot was found 
                */
                echo    "<div class='option'>".
                            "<a href='Check-In.php'>".$answer."</a>".
                        "</div>";
            } 
            else 
            {
                echo    "<div class='option'>".
                            "<a href='?current_question=".($position + 1)."&selection=" . $answer . "'>".$answer."</a>".
                        "</div>";
            }
        }
        
        // After the final question, or if something went wrong
        else 
        {
            echo    "<div class='option'>".
                        "<a href='Check-In.php'>"."This Page Will Reload Shortly..."."</a>".
                    "</div>";
        }
    }

    // Function that prints the suggestions relevant to the questions selected by the driver
    function printSuggestion($position){
        if ($position > 2 && $position < 4)
        {
            echo $GLOBALS['checkForParking_results']['suggestion'];
        } 
        else if ($position == 4)
        {
            echo "Have a nice day!";
        }
    }
?>