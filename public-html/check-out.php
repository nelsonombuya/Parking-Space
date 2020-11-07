<?php
/*========================================= Requirements =========================================*/
    require_once "inc/header.inc.php"; // Also includes config file
/*===============================================================================================*/
?>

<head>
    <title>Checkout</title>

    <!-- Validation Javascript Script -->
    <script type="text/javascript" src="js/checkout.validation.js"></script>
</head>

<body>
    <!--Checkout Section-->
    <div class="container-fluid px-0 py-4 mt-4 text-dark ">
        <div class="row">
            <div class="col-md-12 col-md-offset-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <div class="checkout-head  bg-dark  py-4 text-white">
                                <img src="img/checkout2.png" width="50" height="50" alt="logo">

                                <h2 class="text-center font-weight-bold ">Checkout</h2>
                                <p class="font-italic">Input your parking ticket number</p>

                            </div>
                            <form name="checkout_form" onsubmit="return checkoutValidation();"
                                action="check-out-confirm.php" role="form" autocomplete="off" class="form py-2"
                                method="post">

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Parking ticket number..."
                                        name="parking-spot-ID">
                                </div>
                                <input name="submit" class="btn btn btn-dark mb-4" value="Confirm" type="submit">

                                <div class="form-group">
                                    <div class="go-home py-2 font-italic">
                                        <p class="font-italic">
                                            <a class="navbar-brand" href="index.php">
                                                <img src="img/back.png" width="30" height="30" alt="logo">
                                            </a><small>Go back to <a href="index.php" id="signup">Homepage </small></a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <body>
<?php
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    include_once "inc/footer.inc.php";
/*-------------------------------------------------------------------------------------*/
?>