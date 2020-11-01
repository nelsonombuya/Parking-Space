<?php
/*========================================= Requirements =========================================*/
    require_once "../Resources/Headers/PHP/Header.php";
    require_once "PHP/Checkout.class.php";
    $Checkout = new Checkout($_POST['parking-spot-ID']);
/*===============================================================================================*/
?>
<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/Checkout.css">
    <title>Confirm Checkout</title>
</head>

<body>
    <div class="container">
        <form name="confirm_checkout_form" action="Finalize.php" method="POST">
            <div class="question">
                <h1><?php echo $Checkout->outputs["Heading"]; ?></h1>
            </div>
            <div class="suggestion">
                <h2><?php echo $Checkout->outputs["Subheading"]; ?></h2>
                <br>
                <em><?php echo $Checkout->outputs["Time"]; ?></em>
                <br>
                <?php if (isset($Checkout->outputs["Charges"])){echo "<em>" . $Checkout->outputs["Charges"] . "</em><br>";} ?>
            </div>
            <div class="selection-box">
                <div class="inputs">
                    <?php echo $Checkout->outputs["Buttons"]; ?>
                </div>
                <div class="buttons">
                </div>
            </div>
        </form>
    </div>
    
    <!-- Saving the user data to session just in case they confirm the spot -->
    <?php $Checkout->saveDetailsToSession(); ?>
</body>

</html>