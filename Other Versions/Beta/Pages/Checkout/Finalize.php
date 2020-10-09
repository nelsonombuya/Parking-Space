<?php
    // Including the required files and scripts
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Includes.php";
    require $_SERVER['DOCUMENT_ROOT'] . relative_root_dir . "/Resources/Formats/PHP/Header.php";

    // The relevant functions for this page
    require "PHP/Finalize.inc.php";
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/Checkout.css">
    <title>Finalized Checkout</title>
</head>

<body>
    <div class="container">
        <div class="question">
            <h1>Checkout Successful</h1>
        </div>
        <div class="suggestion">
            <h2>You may leave your parking spot in the next 20 minutes.</h2>
        </div>
    </div>
</body>

</html>