<?php   // Includes 
    require "../../Includes/Configuration/Connection.php";
    require "../../Includes/Code/PHP/Algorithms.php";
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";


    // The array with the data
    $questions_array = [  // This is the Questions Array
        // Questions divided into groups
        "Location" => array
        (
            "question"  =>  "Where do you want go?",
            "answers"   =>  getFromDatabase("Location")
        ),

        // Whether they're just picking up
        "Pick Up" => array
        (
            "question"  =>  "Are you coming to pick up something?",
            "answers"   =>  array
            (
                "Yes",
                "No",
            ),
        ),

        // If they're handicapped
        "Handicap" => array
        (
            "question"  =>  "Are you Handicapped?",
            "answers"   =>  array
            (
                "Yes",
                "No",
            ),
        ),

        // Should be the last question in the array
        "Spot" => array
        (
            "question"  =>  "Would you like this spot?",
            "answers"   =>  array
            (
                "Yes",
                "No",
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
            <h1><?php echo currentQuestion(); ?></h1>
        </div>
        <div class="suggestion">
            <em>Image of tick or error goes here</em>
            <h2>Suggestion Goes here</h2>
        </div>
        <div class="selection-box">
            <div id="back">
                <a href="#"><img src="Media/Images/Back.png" alt="Back"></a>
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
            $_GET['question_group'] = "Location";

        }
        return $GLOBALS['questions_array'][$_GET['question_group']]['question']; 
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
                        "<a href='#'>".
                            $list[$counter].
                        "</a>".
                    "</div>";
        }
    }

    function querySelector($question_group)
    {
        // Returns the query I need for the results
        switch ($question_group)
        {
            case "Location":
                return "SELECT DISTINCT P_LOCATION FROM PARKING";
                break;
            default:
                echo '  <script type="text/JavaScript">  
                            alert("No valid query."); 
                        </script>';
                break;
        }
    }

    function getFromDatabase($question_group)
    {
        // Gets the data from the database and converts it into a format the webpage can work with 
        $query = querySelector($question_group);
        $fetched = mysqli_query($GLOBALS['connect'], $query);
        $arrays = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
        
        // Check the type of answers we need
        if ($question_group === "Location")
        {
            for ($counter = 0; $counter < count($arrays); $counter++)
            {
                $result[$counter] = $arrays[$counter]["P_LOCATION"];
            }
        }
        
        return $result;
    }

    // TODO: Edit this out later
    // echo "<pre>";
    // print_r (getFromDatabase("Location"));
    // print_r ($questions_array["Location"]["answers"]);
    // print_r (getFromDatabase("Location"));
    // echo "</pre>";
?>