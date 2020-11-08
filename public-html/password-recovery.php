<?php
/*===================================== Home Page =====================================*/
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    require_once "inc/header.inc.php";
/*-------------------------------------------------------------------------------------*/
?>

<head>
    <title>Password Recovery</title>
</head>

<!--Password recovery Section-->

<div class="container-fluid px-0 py-4 mt-4 text-dark ">
    <div class="row">
        <div class="col-md-12 col-md-offset-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <a class="navbar-brand" href="#">
                            <img src="img/darkjeep.png" width="50" height="50" alt="logo">
                        </a>
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="glyphicon glyphicon-envelope"></span>
                                        <input id="email" name="email" placeholder="email address" class="form-control"
                                            type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" class="btn btn-lg btn-dark btn-block"
                                        value="Reset Password" type="submit">
                                </div>
                                <div class="form-group">
                                    <p class="text-center">Go back to <a href="login.php" id="signup">Login</a></p>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="">
                                <div class="col-md-12 ">
                                    <div class="login-or">
                                        <hr class="hr-or">
                                        <span class="span-or">or</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="text-center"><a href="sign-up.php" id="signup">Sign up</a></p>
                                </div>
                            </form>

                        </div>
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