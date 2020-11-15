<?php
/*==================================== Login Page =====================================*/
/*---------------------------------- Required Files -----------------------------------*/
    require_once __DIR__ . "/../config/config.inc.php";
    require_once SCRIPTS . "errors.script.php";
    require_once "inc/header.inc.php";
/*-------------------------------------------------------------------------------------*/

    /* Checks if a login error has happened, if not, just run the main script */
    if (isset($_GET['error']))
    {
        echo checkLoginErrors($_GET['error']);
        
        /* Unsets the error after the error message has been shown */
        unset($_GET['error']);
    }

    // If the user is already logged in, redirect to account settings
    if (isset($_SESSION['username'])) header("Location: " . HEADER_ROOT . "/dashboard.php") or die();
?>

<head>
    <title>Login</title>

    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="js/login.validation.js"></script>
    
</head>

<body>
    <!--Login Section-->
    <div class="container-fluid px-0 py-4 mt-4 text-dark ">
        <div class="row">
            <div class="col-md-12 col-md-offset-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <a class="navbar-brand" href="#">
                                <img src="img/account.png" width="50" height="50" alt="logo">
                            </a>
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Account Login</h2>
                            <p>Please fill in the required details.</p>
                            <div class="panel-body">
                                <form id="register-form" name="login_form" role="form" autocomplete="off"
                                    onsubmit="return login_validation();" action="inc/login.inc.php" class="form"
                                    method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="glyphicon glyphicon-envelope"></span>
                                            <input id="email" name="login_username" placeholder="Username/Email * "
                                                class="form-control " type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="password" name="login_password" placeholder="Password *"
                                                class="form-control " type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-center"><a href="password-recovery.php" id="signup">Forgot
                                                password?</a></p>
                                    </div>
                                    <input name="recover-submit" class="btn btn-lg btn-dark btn-block" value="Login"
                                        type="submit">
                            </div>
                            <div class="col-md-12 ">
                                <div class="login-or">
                                    <hr class="hr-or">
                                    <span class="span-or">or</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="text-center">Don't have account? <a href="sign-up.php" id="signup">Sign up
                                        here</a></p>
                            </div>

                            <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    include_once "inc/footer.inc.php";
/*-------------------------------------------------------------------------------------*/
?>