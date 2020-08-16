<?php
    // Defining session errors and what to do if an error had occured
    // Check for a user session
    // TODO: Select Case with Javascript Alerts
    
    // if (checkSession() == 0){
    //     // Meaning there are no session details
    //     echo '  <script type="text/JavaScript">  
    //                 alert("Please Sign In or Continue as Guest"); 
    //             </script>';  // So that they can log in
    // }
    // else if (checkSession() == 2){
    //     // If it's a logged in user
    //     $GLOBALS['username'] = $_SESSION['username'];
    //     $GLOBALS['password'] = $_SESSION['password']; // FIXME: Here
    //     echo '  <script type="text/JavaScript">  
    //                 alert("Checking Session Credentials"); 
    //             </script>';
    // }
    // // Else, for guest sessions and any other unchecked criteria 
    // else{
    //     // FIXME: Guest user accessing their own details    
    //     // header("Location: ../../Sign In.php");  // NOTE: Will use Driver ID
    //     echo '  <script type="text/JavaScript">  
    //                     alert("Please, sign in or continue as guest."); 
    //                 </script>';
    // }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="Code/Javascript/Login Validation.js"></script>

    <!-- Monsterrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Style.css" />

    <!-- Javascript (From Fontawesome) [Has the Username And Password Icons] -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!-- Page Metadata -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <!-- The Background Wave Layer -->
    <img class="wave" src="../../Includes/Media/Images/Wave.png" />

    <!-- The Page Content Container -->
    <div class="container">
        <!-- Image on top of the wave layer -->
        <div class="img">
            <img src="Media/Images/Authentication.svg" />
        </div>
        <!--The Login Box-->
        <div class="login-content">
            <form name="login_form" onsubmit="return login_validation();" action="Code/PHP/Login.php" method="POST">
                <img src="Media/Images/Avatar.svg" />
                <h2 class="title">Account</h2>

                <!-- Username -->
                <div class="input-div username">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" name="login_username" class="input" />
                    </div>
                </div>

                <!-- Password -->
                <div class="input-div password">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="login_password" class="input" />
                    </div>
                </div>
                <a href="#">Forgot Password?</a>
                <!-- TODO: Come back here to link to the password recovery page -->
                <input type="submit" class="btn" value="Sign In" />
                <a href="../../index.php"><button type="button" class="btn" value="Guest">Continue as Guest</button></a>
                <!-- TODO: Allow guest to see basic information -->
            </form>
        </div>
    </div>

    <!--Linking the Transitions script-->
    <script type="text/javascript" src="Code/Javascript/Transitions.js"></script>
</body>

</html>