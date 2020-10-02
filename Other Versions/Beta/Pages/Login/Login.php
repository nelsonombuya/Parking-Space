<?php
    // TODO: Refactoring this page
    // Defining session errors and what to do if an error had occured
    // Check for a user session
    // include("../../Includes/Configuration/Session.php");
    
    // Error checking
    // function checkSessionErrors(){
    //     // Checks the error code and displays relevant error messages
    //     switch ($_SESSION['login_error']){
    //         case "wrong_username_password": 
    //             $error ='<script type="text/JavaScript">  
    //                         alert("Incorrect username or password"); 
    //                     </script>';
    //         break;
            
    //         default:    
    //             // If a different kind of error occurs
    //             $error ='<script type="text/JavaScript">  
    //                         alert("Please, sign in or continue as guest."); 
    //                     </script>';
    //         break;
    //     }
    //     // Unsets the session error after the error message has been shown
    //     unset($_SESSION['login_error']);
        
    //     // Returns the error as a javascript alert
    //     return $error;
    // }

    // Checks if the error has happened, if not, just run the main script
    // if (isset($_SESSION['login_error'])){
    //     checkSessionErrors(); 
    // }    

    // // Redirecting the user to the account management page
    // if (isLoggedIn()){
    //     header("Location: ..\..\Pages\Management\Account Management.php");
    // }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="Javascript/Login Validation.js"></script>

    <!-- Monsterrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="CSS/Login.css" />

    <!-- Javascript (From Fontawesome) [Has the Username And Password Icons] -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!-- Page Metadata -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <!-- The Background Wave Layer -->
    <img class="wave" src="../../Resources/Images/Wave.png" />

    <!-- The Page Content Container -->
    <div class="container">
        <!-- Image on top of the wave layer -->
        <div class="img">
            <img src="../../Resources/Images/Authentication.svg" />
        </div>
        <!--The Login Box-->
        <div class="login-content">
            <form name="login_form" onsubmit="return login_validation();" action="PHP/Login.inc.php"
                method="POST">
                <img src="../../Resources/Images/Avatar.svg" />
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
                <a href="../../Index.php"><button type="button" class="btn" value="Guest">Continue as Guest</button></a>
            </form>
        </div>
    </div>

    <!-- Transitions Javascript-->
    <script type="text/javascript" src="Javascript/Transitions.js"></script>
</body>

</html>