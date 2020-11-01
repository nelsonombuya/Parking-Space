<body>
    <!--The Background Wave Layer-->
    <img class="wave" src="..\..\Includes\Media\Images\Wave.png" alt="Background">
    <header id=top_header>
        <!--The Driver's Details Container-->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#<?php echo (driverNumber() + 1); ?></h1>
            </div>
            <div class="user_id">
                <a href="..\..\Pages\Management\Account Management.php">
                    <h2><?php echo $_SESSION['username'];?></h2>
                </a>
            </div>
        </div>

        <!--The Logo Container-->
        <div class="logo">
            <a href="../../index.php">
                <img src="..\..\Includes\Media\Images\Jeep.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Cog Container-->
        <div class="settings">
            <a href="..\..\Pages\Login\Sign In.php"><img src="..\..\Includes\Media\Images\Settings.png"
                    alt="Settings"></a>
            <a href="?logout=true"><img src="..\..\Includes\Media\Images\Logout.png" alt="Logout"></a>
        </div>
    </header>
</body>

<?php
    if(isset($_GET['logout'])){
        logout();
        header("Location: ../../index.php");
    }
?>