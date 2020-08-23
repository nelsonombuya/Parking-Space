<?php   // Includes 
    require "../../Includes/Configuration/Connection.php";
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";

    // Initializing Array of Selected Options
    $selected_array = array();

    // The array with the data
    $questions_array = [  // This is the Questions Array
        // Questions divided into groups
        0 => array
        (
            "question"  =>  "Where do you want go?",
            "answers"   =>  getLocationsFromDatabase()
        ),

        // Whether they're just picking up
        1 => array
        (
            "question"  =>  "How long will you stay?",
            "answers"   =>  array
            (
                "Less than 30 Minutes",
                "More than 30 Minutes",
            ),
        ),

        // If they're handicapped
        2 => array
        (
            "question"  =>  "Are you Handicapped?",
            "answers"   =>  array
            (
                "Yes",
                "No",
            ),
        ),

        // Should be the last question in the array
        3 => array
        (
            "question"  =>  "Would you like this spot?",
            "answers"   =>  array
            (
                "Yes",
                "No",
            ),
        ),
    ];

    // Helps the questions array be modifiable without modifying the code
    $last_question = count($questions_array) - 1;
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
            <h1><?php echo currentQuestion(); ?></h1>
        </div>
        <div class="suggestion">
            <em>Image of tick or error goes here</em>
            <h2><?php echo suggestions() ?></h2>
        </div>
        <div class="selection-box">
            <div id="back">
                <a href="javascript:history.back()"><img src="Media/Images/Back.png" alt="Back"></a>
            </div>
            <div class="options">
                <?php currentOptions(); ?>
            </div>

        </div>
    </div>
</body>

<?php   // For the Page Questions_array and redirects
    function currentQuestion()
    {
        // Outputs the current question according to the associative array and user input
        if (!isset($_GET['question_group']))
        {
            $_GET['question_group'] = 0;

        }
        return $GLOBALS['questions_array'][$_GET['question_group']]['question']; 
    }

    function getLocationsFromDatabase()
    {
        // Gets the data from the database and converts it into a format the webpage can work with 
        $query = "SELECT DISTINCT P_LOCATION FROM PARKING";
        $fetched = mysqli_query($GLOBALS['connect'], $query);
        $arrays = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
        
        // Converting the array
        for ($counter = 0; $counter < count($arrays); $counter++)
        {
            $result[$counter] = $arrays[$counter]["P_LOCATION"];
        }
        
        return $result;
    }

    function currentOptions()
    {
        /* 
            Gives an array of answers for the given question
            Then outputs that array on the HTML
        */ 

        // Initializing Variables
        $counter = 0;
        $list = array();

        foreach ($GLOBALS['questions_array'][$_GET['question_group']]['answers'] as $options => $option)
        {
            // Gets the array of options
            $list[$counter] = $option;
            $counter++;
        }

        // Displays the output
        for($counter = 0; $counter < count($list); $counter++)
        {  
            echo    "<div class='option'>".
                        "<a href='?question_group=" . ($_GET['question_group'] + 1) .
                            "&selected=". $list[$counter] .
                            "&set=". ($_GET['question_group'] + 1) .
                            "'>".
                            $list[$counter].
                        "</a>".
                    "</div>";
        }

        // Adding the values to the session array
        if (isset($_GET['set']) && $_GET['set'] > 0)
        {
            selected(($_GET['question_group'] - 1), $_GET['selected']);
        }
    }

    function selected($question, $value)
    {
        $_SESSION['selected'][$question] = $value;
    }

    function suggestions()
    {
        // Suggesting Parking Spots
        if ($_GET['question_group'] >= $GLOBALS['last_question'])
        {
            // The parking location
            $parking_location = $_GET['selected_0'];

            // The type of parking spot
            if ($_GET['selected_2'] === "Yes")
            {
                // If they're handicapped, prioritise a handicapped parking
                $parking_type = "Handicapped";
            }
            else if ($_GET['selected_1'] === "Less than 30 Minutes")
            {
                // If they're coming for a short time, prioritise Pick Up Parking
                $parking_type = "Pick Up";
            }
            else
            {
                // If it's not Pick Up, and not Handicapped, give them any open parking
                $parking_type = "Open";
            }

            $query = "SELECT P_ID FROM PARKING
                        WHERE P_TYPE = '$parking_type'
                        AND P_STATUS = 'Free'
                        AND P_LOCATION = '$parking_location'";
            $fetched = mysqli_query($GLOBALS['connect'], $query);
            $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);

            if (empty($result))
            {
                // If there's no parking spot found, we need to give them the next available parking spot
                // TODO: Next available parking spot;
                return "No Parking Spot Found";
            }
            else
            {
                // If there is a parking spot, return the first spot on the list
                return $result[0];
            }
        }
    }

    // TODO: Edit this out later
    echo "<pre>";
    // print_r (suggestions());
    // print_r ($questions_array[0]["answers"]);
    print_r ($_SESSION['selected']);
    echo $_GET['selected'];
    echo "</pre>";
    // selected($_GET['question_group'] - 1, $_GET["selected_".$_GET['question_group'].""])
    // "&selected_".$_GET['question_group']."=". $list[$counter] .
?>