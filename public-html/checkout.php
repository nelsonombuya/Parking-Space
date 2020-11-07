<?php
/*========================================= Requirements =========================================*/
    require_once "inc/header.inc.php"; // Also includes config file
/*===============================================================================================*/
?>

<head>
    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="js/checkout.validation.js"></script>

    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
    <title>Checkout</title>
</head>

<body>
    <div class="container">
        <form name="checkout_form" onsubmit="return checkoutValidation();" action="checkout.confirm.php" method="post">
            <div class="question">
                <h1>Input your Parking Ticket Number </h1>
            </div>
            <div class="selection-box">
                <div class="inputs">
                    <div id="back">
                        <a href="javascript:history.back()">
                            <img src="img/back.png"alt="Back">
                        </a>
                    </div>
                    <div class="textbox">
                        <input autofocus type="text" name="parking-spot-ID">
                    </div>
                    <div class="confirm">
                        <input type="submit" value="Confirm">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>