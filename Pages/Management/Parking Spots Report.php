<?php   // Includes 
    require "../../Includes/Configuration/Connection.php";
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php"; 
?>
<head>
    <!--For the Reports-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Reports Style.css">
</head>
<body>
    <div class="container">
        <!--Report Heading Space-->
        <div class="report-heading-space">
            <!-- <h1>Report Heading</h1> -->
            <h1>Parking Spots</h1>
        </div>

        <!--Container that'll hold the Account holder's details-->
        <div class="report-title">
            <!-- <h2>Report Sub-Heading</h2> -->
            <h2>All Parking Spot Details</h2>
        </div>
        <div class="column-titles">
                <strong><h3>Spot ID</h3></strong>
                <strong><h3>Type</h3></strong>
                <strong><h3>Status</h3></strong>
        </div>
        <div class="report-content">
            <div class="column">
                <?php
                    $query  = "SELECT * FROM PARKING";
                    $fetched = mysqli_query($GLOBALS['connect'], $query);
                    $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
                    foreach($result as $parking_spot): ?>
                        <div class="results">
                            <br><?php echo $parking_spot['P_ID']; ?><br>
                        </div>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <?php
                    $query  = "SELECT * FROM PARKING";
                    $fetched = mysqli_query($GLOBALS['connect'], $query);
                    $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
                    foreach($result as $parking_spot): ?>
                        <div class="results">
                            <br><?php echo $parking_spot['P_TYPE']; ?><br>
                        </div>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <?php
                    $query  = "SELECT * FROM PARKING";
                    $fetched = mysqli_query($GLOBALS['connect'], $query);
                    $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
                    foreach($result as $parking_spot): ?>
                        <div class="results">
                            <br><?php echo $parking_spot['P_STATUS']; ?><br>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>