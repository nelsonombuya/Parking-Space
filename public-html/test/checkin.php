<?php
/*========================================= Requirements =========================================*/
    require_once __DIR__ . "/inc/header.inc.php"; // The config file is already included in the header
    require_once CLASSES . "checkin.class.php";
    $Check_In = new CheckIn;
    $back = ($_GET['page'] == 4) ? "checkin.php?page=2" : "javascript:history.back()";
/*===============================================================================================*/
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="css/checkin.css">
    <title>Check-In</title>
</head>

<body>
    <div class="container">
        <div class="question">
            <h1><?php echo $Check_In->heading; ?></h1>
        </div>

        <div class="suggestion">
            <h2><?php echo $Check_In->subheading; ?></h2>
        </div>

        <div class="selection-box">
            <div id="back">
                <a href="<?php echo $back?>">
                    <img src="img/back.png" alt="Back">
                </a>
            </div>
            <div class="options">
                <?php $Check_In->printoptions(); ?>
            </div>
        </div>
    </div>

    <!-- Saving User Selections -->
    <?php if ($_GET['page'] > 0) $Check_In->saveSelections($_GET['page'], $_GET['selection']); ?>

    <!-- If a booking occurs successfully -->
    <?php if ($_GET['page'] > 4) header("refresh:10; url=checkin.php") or die(); ?>
</body>