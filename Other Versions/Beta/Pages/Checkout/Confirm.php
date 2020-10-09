<?php
    // Including the required files and scripts
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Includes.php";
    require $_SERVER['DOCUMENT_ROOT'] . relative_root_dir . "/Resources/Formats/PHP/Header.php";

    // The relevant functions for this page
    require "PHP/Confirm.inc.php";
?>
<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/Checkout.css">
    <title>Confirm Checkout</title>
</head>

<body>
    <div class="container">
        <?php $outputs = outputParkingDetails(); ?>
        <form name="confirm_checkout_form" onsubmit="<?php saveDetailsToSession(); ?>" action="Finalize.php" method="post">
            <div class="question">
                <h1><?php echo $outputs["Question"]; ?></h1>
            </div>
            <div class="suggestion">
                <h2><?php echo $outputs["Details"]; ?></h2>
                <br>
                <em><?php echo $outputs["Time"]; ?></em>
                <br>
            </div>
            <div class="selection-box">
                <div class="inputs">
                    <?php echo $outputs["Buttons"]; ?>
                </div>
                <div class="buttons">
                </div>
            </div>
        </form>
    </div>
</body>

</html>