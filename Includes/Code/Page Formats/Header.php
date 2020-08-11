<body>
    <!--The Background Wave Layer-->
	<img class="wave" src="..\..\Includes\Media\Images\Wave.png" alt="Background">
    <header id=top_header>
        <!--The Driver's Details Container-->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#<?php echo session_outputs('username');?></h1>
            </div>
            <div class="user_id">
                <a href="..\..\Pages\Management\Account Management.php"><h2><?php echo session_outputs('username');?></h2></a>  <!--TODO: Make it use a function that detects whether the user is logged in-->
            </div>
        </div>

        <!--The Logo Container-->
        <div class="logo">
            <a href="../../index.php">
                <img src="..\..\Includes\Media\Images\Logo.png" alt="Logo">
            </a>
        </div>

        <!--The Settings Cog Container-->
        <div class="settings">
            <a href="..\..\Pages\Login\Login.html"><img src="..\..\Includes\Media\Images\Settings.png" alt="Settings"></a>
            <a href="<?php logout() ?>"><img src="..\..\Includes\Media\Images\logout.svg" alt="Logout"></a>
        </div>
        <!--TODO: Set a sign out button-->
    </header>
</body>