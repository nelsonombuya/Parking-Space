<?php   // Includes 
    include "../../Includes/Code/Page Formats/Head.php";;
    include "../../Includes/Code/Page Formats/Header.php";

    //Naming the page
    $_SESSION['page_title'] = "Car Parking System - Account Management";
?>
<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Style.css">
</head>
<body>
    <div class="heading-space">
        <h1>Account Management</h1>
    </div>
    <div class="container">
        <!--Container that'll hold the Account holder's details-->
        <div class="account-settings">
            <h2>Settings</h2>
        </div>
        <div class="account-details">
            <h2><?php echo session_outputs('username');?>'s Details</h2>
        </div>
        <div class="user-settings">
            <ul>
                <li><h3>Lorem</h3></li>
                <li><h3>Lorem</h3></li>
                <li><h3>Lorem</h3></li>
                <li><h3>Lorem</h3></li>
            </ul>
        </div>
        <div class="Pages">
            <h3><a href="Parking Spots Report.php">Parking Spots Report</a></h3>
        </div>
    </div>
</body>
</html>