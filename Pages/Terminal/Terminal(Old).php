<?php   // Includes 
    require "../../Includes/Configuration/Connection.php";
    require "../../Includes/Code/PHP/Queue.php";
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";


    // The array with the data
    $questions = [
        "0" => array
        (
            "question"  =>  "Where do you want go?",
            "options"   =>  getLocationsArray(),
        ),

        // Whether they're just picking up
        "1" => array
        (
            "question"  =>  "Are you coming to pick up something?",
            "options"   =>  array
            (  // NOTE: Made it into this nested array in order to allow the code to remain the same
                array
                (
                    "Yes",
                    "No"
                ) 
            ),
        ),

        // Should be the last question in the array
        "2" => array
        (
            "question"  =>  "Would you like this spot?",
            "options"   =>  array
            ( // NOTE: Made it into this nested array in order to allow the code to remain the same
                array
                (
                    "Yes",
                    "No"
                ) 
            ),
        ),
    ];
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Style.css">
    <title>Terminal</title>
</head>

<body>
    <!-- Proceed with the Rest of the Body Container -->
    <div class="container">
        <div class="question">
            <h1><?php echo $GLOBALS['questions'][currentQuestion()]['question']; ?></h1>
        </div>
        <div class="suggestion">
            <!-- TODO: The Parking Spot Suggestion  -->
            <!-- <em></em>
            <h2><?php // echo printFirstAvailableParking() ?></h2> -->
        </div>
        <div class="options">
            <div id="back">
                <a href="javascript:history.back()"><img src="Media/Images/Back.png" alt="Back"></a>
            </div>
            <div class="select">
                <!-- Pick the question from the associative array -->
                <?php $options = $GLOBALS['questions'][currentQuestion()]['options'];?>
                <?php foreach($options as $options_arrays => $keys):?>
                <?php foreach($keys as $key => $value):?>
                <div class="option">
                    <!-- TODO: Needs Cleaning -->
                    <!-- Creating an exception for when the user chooses no -->
                    <?php
                        if ($value === "No"){   ?>
                    <a href="javascript:history.back()"><?php echo $value; ?></a>
                    <?php } else { ?>
                    <a href="?<?php echo "question=" . (currentQuestion() + 1); ?>"><?php echo $value; ?></a>
                    <!-- TODO: Add GET Values for each of the options chosen -->
                    <?php } ?>
                </div>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>

<?php   // For the Page Questions and redirects
    function currentQuestion(){
        if (isset($_GET['question'])){
            switch ($_GET['question']){
                case 0:
                    return 0;
                break;
                case 1:
                    return 1;
                break;
                default:
                    return 404;
                break;
            }
        }
        // If it is unset, start with the first question
        $_GET['question'] = 0;
        return 0;
    }

    // TO: Get the Locations from the database
    function getLocationsArray(){
        // Querying the values from the database
        $query = "SELECT DISTINCT P_LOCATION FROM PARKING";
        $fetched = mysqli_query($GLOBALS['connect'], $query);
        $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);

        // Returning the Array
        return $result;
    }

    function getAvailableParking($location){
        // Querying the values from the database
        $query = "SELECT P_ID FROM PARKING WHERE P_LOCATION = '$location' AND P_STATUS = 'Free'";
        $fetched = mysqli_query($GLOBALS['connect'], $query);
        $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);

        // Returning the Array
        return $result;
    }

    function printFirstAvailableParking(){
        if (!isset($_GET['question']) || $_GET['question'] != 0)
        {
            return "Parking Spot ". (getAvailableParking("Mall")['0']['P_ID']) ." is available";
        }
    }

    // TODO: Edit this out later
    echo "<pre>";
    print_r (getAvailableParking("Mall"));
    echo "</pre>";
?>