<body>
    <!--The Background Wave Layer-->
	<img class="wave" src="..\..\Includes\Media\Images\Wave.png" alt="Background">
    <header id=top_header>
        <!--The Driver's Details Container-->
        <div class="driver_details">
            <div class="driver_number">
                <h1>#Driver ID</h1>
            </div>
            <div class="user_id">
                <h2>#<?php echo $_SESSION['username'];?></h2>
            </div>
        </div>

        <!--The Logo Container-->
        <div class="logo">
            <img src="..\..\Includes\Media\Images\Logo.png" alt="Logo">
        </div>

        <!--The Settings Cog Container-->
        <div class="settings">
            <a href="Pages\Login\Login.html"><img src="..\..\Includes\Media\Images\Settings.png" alt="Settings"></a>
        </div>
    </header>
</body>