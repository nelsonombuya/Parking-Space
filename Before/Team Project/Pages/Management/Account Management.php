<?php   // Includes 
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";
?>

<head>
    <!--The Page's Unique CSS-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Style.css">
    <title>Account Management</title>
</head>

<body>
    <div class="heading-space">
        <h1>Account Management</h1>
        <h2><?php echo $_SESSION['username'];?></h2>
    </div>
    <div class="container">
        <!--Container that'll hold the Account holder's details-->
        <div class="settings-menu">
            <u>
                <h2>Settings</h2>
            </u>
            <div class="user-settings">
                <ul>
                    <li>
                        <h3>Reports</h3>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pages">
            <u>
                <h2>Options</h2>
            </u>
            <div>
                <h3>Parking Reports</h3>
                <ul>
                    <li>
                        <h3><a href="Reports.php?report=parking&type=all">All Parking Spots</a></h3>
                        <h3><a href="Reports.php?report=parking&type=free">Free Parking Spots</a></h3>
                        <h3><a href="Reports.php?report=parking&type=reserved">Reserved Parking Spots</a></h3>
                    </li>
                </ul>
            </div>
            <div>
                <h3>Driver Reports</h3>
                <ul>
                    <li>
                        <h3><a href="Reports.php?report=drivers&type=all">All Drivers</a></h3>
                        <h3><a href="Reports.php?report=drivers&type=registered">Registered Drivers</a></h3>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</body>

</html>