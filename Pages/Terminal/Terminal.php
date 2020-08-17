<?php   // Includes 
    require "../../Includes/Configuration/Connection.php";
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";

    // The array with the data
    $questions = [
        "0" => array(
            "question"  =>  "Where would you like to go?",
            "options"   =>  array(
                "Mall",
                "Chemist",
                "KFC",
                "Equity Bank",
            )
        ),
        "1" => array(
            "question"  =>  "Would you like this parking?",
            "options"   =>  array(
                "Yes",
                "No" 
            )
        )
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
        <div class="options">
            <div id="back">
                <a href="javascript:history.back()"><img src="Media/Images/Back.png" alt="Back"></a>
            </div>
            <div class="select">
                <?php $options = $GLOBALS['questions'][currentQuestion()]['options'];?>
                <!-- Pick the question from the associative array -->
                <?php foreach($options as $option):?>
                <div class="option">
                    <a href="?<?php echo "question=" . (currentQuestion() + 1); ?>"><?php echo $option; ?></a>
                </div>
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

    // TODO: Edit this out later
    // echo "<pre>";
    // print_r ($questions);
    // echo array_keys($questions);
    // echo "</pre>";
?>