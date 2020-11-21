<?php
/*===================================== Home Page =====================================*/
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    require_once "inc/header.inc.php";
    require_once SCRIPTS . "errors.script.php";

    /* Checks if a login error has happened, if not, just run the main script */
    if (isset($_GET['error']))
    {
        /* Returns Javascript depending on the error experienced */
        echo checkSignUpErrors($_GET['error']);
        
        /* Unsets the error after the error message has been shown */
        unset($_GET['error']);
    }
/*-------------------------------------------------------------------------------------*/
?>

<head>
    <title>Sign up</title>
</head>


<!-- Signup Section -->

<section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="row">
            <div class=" col-md-4 py-4 text-white text-center ">
                <div class="rounded-left" id="left-side">
                    <div class="card-body">
                        <h2 class="py-4 font-weight-bold" id="sign-head">
                            WELCOME TO
                        </h2>
                        <img src="img/lightjeep.png" width="50" height="50" alt="logo">

                        <h2 class="py-4 font-weight-bold" id="sign-head">
                            Parking Space Car Parking System
                        </h2>
                        <p class="pt-5 font-italic">Sign up to enjoy ease of parking with a touch of class.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-4 border-0">
                <h2 class="font-weight-bold">Sign up</h2>
                <h4 class="pb-4 font-italic">Please fill with your details</h4>
                <form name="sign-up_form" onsubmit="return signUp_validation();" action="inc/sign-up.inc.php"
                    method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="First Name" name="first_name" placeholder="First Name *" class="form-control"
                                type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="Last Name" name="last_name" placeholder="Last Name *" class="form-control"
                                type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="Username" name="username" placeholder="Username *" class="form-control"
                                type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="numberplate" name="number_plate" placeholder="Car Number Plate *"
                                class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="ID-No" name="id_number" placeholder="ID Number *" class="form-control"
                                type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="phone" name="phone" placeholder="Phone Number *" class="form-control"
                                type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input id="password" name="password" placeholder="Enter Password *" class="form-control "
                                type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input id="password" name="password-confirm" placeholder="Confirm Password *"
                                class="form-control " type="password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="invalidCheck2">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
                                            required>

                                        <small>By clicking Submit, you agree to our Terms & Conditions, Visitor
                                            Agreement and Privacy
                                            Policy.</small>

                                    </label>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-row">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                    <div class="form-group">
                        <p class="text-center py-4">Already have an account? <a href="login.php" id="signup">Login
                                here</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<?php
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    include_once "inc/footer.inc.php";
/*-------------------------------------------------------------------------------------*/
?>