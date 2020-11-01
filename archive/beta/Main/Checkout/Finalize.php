<?php
/*========================================= Requirements =========================================*/
    require_once "../Resources/Headers/PHP/Header.php";
    require_once "PHP/Checkout.class.php";
    $Checkout = new Checkout($_SESSION['parking_spot_ID']);
/*===============================================================================================*/
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/Checkout.css">
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
</body>

</html>