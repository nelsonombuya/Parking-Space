<?php
    // Including the required files and scripts
    require "../Resources/Scripts/Settings.inc.php";
    require "../Resources/Headers/PHP/Header.php";
    
    // Scripts for this page
    require "PHP/Globals.inc.php";
    require "PHP/Booking.inc.php";
    require "PHP/Outputs.inc.php";
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/Check-In.css">
    <title>Check-In</title>
</head>

<body>
    <div class="container">
        <div class="question">
            <h1><?php printQuestion($_GET['current_question']); ?></h1>
        </div>
        <div class="suggestion">
            <h2><?php printSuggestion($_GET['current_question']); ?></h2>
        </div>
        <div class="selection-box">
            <div id="back">
                <a href="javascript:history.back()">
                    <img src="<?php echo relative_root_dir; ?>/Resources/Images/Back.png" alt="Back">
                </a>
            </div>
            <div class="options">
                <?php printAnswers($_GET['current_question']); ?>
            </div>
        </div>
    </div>
    <?php saveAnswers($_GET['current_question']); ?>
</body>

<?php
    // Handling the driver's answers 
    function saveAnswers($position)
    {
        // Stores their previously selected answer as a list in session
        if ($position > 0)
        {
            $_SESSION['selection'][$position - 1] = $_GET['selection'];
        }
    }

    // Once the parking has been confirmed, it runs the booking process
    if ($_GET['current_question'] >= 4)
    {
        // Runs the booking query and stores it's output for error checking
        bookParking();
        $_SESSION['booked'] = TRUE;
        header("refresh:5; url=Check-In.php");
    }
?>