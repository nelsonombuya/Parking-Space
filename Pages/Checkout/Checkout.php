<?php   
    // Includes 
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";
?>

<head>
    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="Code/Javascript/Checkout Validation.js"></script>

    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Style.css">
    <title>Checkout</title>
</head>

<body>
    <div class="container">
        <form name="checkout_form" onsubmit="return checkoutValidation();" action="Code/PHP/Confirm Checkout.php" method="post">
            <div class="question">
                <h1>Input your Parking Ticket Number </h1>
            </div>
            <div class="selection-box">
                <div class="inputs">
                    <div id="back">
                        <a href="javascript:history.back()"><img src="../../Includes/Media/Images/Back.png"
                                alt="Back"></a>
                    </div>
                    <div class="textbox">
                        <input type="text" name="parking-id">
                    </div>
                    <div class="confirm">
                        <input type="submit" value="confirm">
                    </div>
                </div>
                <div class="buttons">
                </div>
            </div>
        </form>
    </div>
</body>

</html>