<?php
/*===================================== Home Page =====================================*/
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    require_once "inc/header.inc.php";
    require_once SCRIPTS . "errors.script.php";
/*-------------------------------------------------------------------------------------*/
    /* Checks if an error has happened, if not, just run the main script */
    if (isset($_GET['error']))
    {
        echo checkChangePasswordErrors($_GET['error']);
        
        /* Unsets the error after the error message has been shown */
        unset($_GET['error']);
    }
?>

<head>
    <title>Reset Password</title>
</head>


<!-- Password Reset Section-->
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
                        <h2 class="text-center">Change Password</h2>
                        <p>Please enter your new password below.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="inc/password-change.inc.php">

                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="old-password" placeholder="Enter Old Password *"
                                            class="form-control " type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="new-password" placeholder="Enter New Password *"
                                            class="form-control " type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="confirm-password" placeholder="Confirm New Password *"
                                            class="form-control " type="password">
                                    </div>
                                </div>
                                <input name="recover-submit" class="btn btn-lg btn-dark btn-block mb-4"
                                    value="Change Password" type="submit">
                        </div>
                        <div class="form-group">
                            <p class="text-center">Note: Keep your password safe to avoid inconviniences</p>
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