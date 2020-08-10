<?php   // Includes 
    include "../../Includes/Code/Page Formats/Head.php";;
    include "../../Includes/Code/Page Formats/Header.php";

    //Naming the page
    $_SESSION['page_title'] = "Car Parking System - Account Management";
?>
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
            <h2><?php echo $_SESSION['username']; ?>'s Details</h2>
        </div>
    </div>
</body>
</html>