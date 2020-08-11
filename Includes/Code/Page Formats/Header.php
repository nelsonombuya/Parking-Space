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
                <a href="..\..\..\Pages\Management\Account Management.php"><h2><?php echo session_outputs('username');?></h2></a>
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
            <a href="<?php echo already_logged_in(); ?>"><img src="..\..\Includes\Media\Images\Settings.png" alt="Settings"></a>
        </div>
        <!--TODO: Set a sign out button-->
    </header>
</body>