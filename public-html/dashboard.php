<?php
/*===================================== Dashboard Page =====================================*/
/*-------------------------------------- REQUIREMENTS --------------------------------------*/
    require_once "inc/header.inc.php";
    require_once CLASSES . "dashboard.class.php";
    $Dashboard = new Dashboard;

    /* If no user is logged in, redirect to login page */
    if (!isset($_SESSION['username'])) header("Location: " . HEADER_ROOT . "/login.php") or die();
/*------------------------------------------------------------------------------------------*/
?>

<head>
    <title>Dashboard</title>
</head>

<body>
    <!--Main Dashboard Section-->
    <section class="testimonial pt-5" id="testimonial">
        <div class="container">
            <div class="row ">
                <div class=" col-md-4 py-4 text-white text-center ">
                    <div class="rounded-left " id="left-side">
                        <div class="card-body">

                            <img src="img/lightjeep.png" width="50" height="50" alt="logo">

                            <h2 class="pb-5 font-weight-bold" id="sign-head">
                                DASHBOARD
                            </h2>
                            <p class="py-5 font-italic">Bringing tomorrow, today.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 py-4 border-0">
                    <h3 class="font-weight-bold pb-3">WELCOME <?php echo $Session->username; ?></h3>



                    <div class="row">
                        <div class="col-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <?php $Dashboard->printCategories(); ?>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="tab-content" id="nav-tabContent">
                                <?php $Dashboard->printOptions(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="go-home py-2 font-italic">
                        <p>
                            <a class="navbar-brand" href="index.php">
                                <img src="img/back.png" width="30" height="30" alt="logo">
                            </a><small>Go back to <a href="index.php" id="signup">Homepage.</small> </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    include_once "inc/footer.inc.php";
/*-------------------------------------------------------------------------------------*/
?>