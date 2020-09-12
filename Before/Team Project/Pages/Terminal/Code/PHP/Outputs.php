<?php
    // Returns the question from the specified position in the array
    function printCurrentQuestion($position){
        if ($position <= 2){
            echo $GLOBALS['questions_array'][$position]['question'];
        } 
        else if ($_GET['position'] < 4){
            echo checkForParking()['question'];
        } 
        else {
            echo "Parking has been booked successfully.";
        }
    }

    function printCurrentAnswers($position){
        // First, we get the answers from the array and then print each answer
        if ($position <= 2){
            foreach ($GLOBALS['questions_array'][$position]['answers'] as $answers_array => $answer){
                echo    "<div class='option'>".
                            "<a href='?position=".($position + 1).
                                "&selection=".$answer.
                                "'>".
                                $answer.
                            "</a>".
                        "</div>";
            }
        } else if ($position < 4) {
            $answer = checkForParking()['answers'];
            if ($answer !== "Confirm"){
                echo    "<div class='option'>".
                            "<a href='Terminal.php'>".
                                $answer.
                            "</a>".
                        "</div>";
            } else {
                echo    "<div class='option'>".
                            "<a href='?position=".($position + 1).
                                "&selection=" . $answer . "'>".
                                $answer.
                            "</a>".
                        "</div>";
            }
        } else {
            echo    "<div class='option'>".
                        "<a href='Terminal.php'>".
                            "This Page Will Reload Shortly...".
                        "</a>".
                    "</div>";
        }
    }

    function printSuggestion($position){
        if ($position > 2 && $position < 4){
            echo checkForParking()['suggestion'];
        } 
        else if ($position == 4){
            echo "Have a nice day!";
        }
    }
?>