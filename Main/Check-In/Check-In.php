<?php
/*========================================= Requirements =========================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Main/Resources/Headers/PHP/Header.php";
    require_once "PHP/Check-In.class.php";
    $Check_In = new CheckIn;
/*===============================================================================================*/
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/Check-In.css">
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
                <a href="javascript:history.back()">
                    <img src="<?php echo $Check_In->version_dir_relative; ?>/Resources/Images/Back.png" alt="Back">
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
    <?php if ($_GET['page'] > 3) header("refresh:10; url=Check-In.php") or die(); ?>
</body>