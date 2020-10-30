<?php
/*========================================= Requirements =========================================*/
    require_once "../Resources/Headers/PHP/Header.php";
/*===============================================================================================*/
?>

<head>
    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="JS/Validation.js"></script>

    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/Checkout.css">
    <title>Checkout</title>
</head>

<body>
    <div class="container">
        <form name="checkout_form" onsubmit="return checkoutValidation();" action="Confirm.php" method="post">
            <div class="question">
                <h1>Input your Parking Ticket Number </h1>
            </div>
            <div class="selection-box">
                <div class="inputs">
                    <div id="back">
                        <a href="javascript:history.back()">
                            <img src="../Resources/Images/Back.png"alt="Back">
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