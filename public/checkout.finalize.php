<?php
/*========================================= Requirements =========================================*/
    require_once "inc/header.inc.php";
    require_once CLASSES . "checkout.class.php";
    $Checkout = new Checkout($_SESSION['parking_spot_ID']);
/*===============================================================================================*/
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
    <title>Finalized Checkout</title>
</head>

<body>
    <div class="container">
        <div class="question">
            <h1><?php echo $Checkout->outputs["Heading"]; ?></h1>
        </div>
        <div class="suggestion">
            <h2><?php echo $Checkout->outputs["Subheading"]; ?></h2>
        </div>
    </div>
    <!-- Once everything's done, clean up -->
    <?php $Checkout->cleanUp(); ?>
    <?php header("refresh:7; url=checkout.php") or die(); ?>
</body>

</html>