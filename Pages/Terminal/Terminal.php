<?php   
    // Includes 
    include "../../Includes/Code/Page Formats/Head.php";
    require "Code/PHP/Globals.php";
    initializeGlobals();
    require "Code/PHP/Booking.php";
    require "Code/PHP/Outputs.php";
    include "../../Includes/Code/Page Formats/Header.php";
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
            <h1><?php printCurrentQuestion($_GET['position']); ?></h1>
        </div>
        <div class="suggestion">
            <h2><?php printSuggestion($_GET['position']); ?></h2>
        </div>
        <div class="selection-box">
            <div id="back">
                <a href="javascript:history.back()"><img src="Media/Images/Back.png" alt="Back"></a>
            </div>
            <div class="options">
                <?php printCurrentAnswers($_GET['position']); ?>
            </div>
        </div>
    </div>
    <?php saveAnswers($_GET['position']); ?>
</body>

<?php   // For the Page Questions_array and redirects    
    function saveAnswers($position){
        // Stores their previous answer as a list in session
        if ($position > 0){
            $_SESSION['selection'][$position - 1] = $_GET['selection'];
        }
    }

    // Once the parking has been confirmed, it runs the booking process
    if ($_GET['position'] >= 4){
        // // Runs the booking query and stores it's output for error checking
        bookParking();
        $_SESSION['booked'] = TRUE;
        header("refresh:5; url=Terminal.php");
    }
?>