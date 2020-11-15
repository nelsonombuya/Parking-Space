<?php
/*========================================= Requirements =========================================*/
    require_once __DIR__ . "/inc/header.inc.php";
    require_once CLASSES . "checkin.class.php";
    $Check_In = new CheckIn;
/*===============================================================================================*/
?>
<html lang="en">

<head>
    <title>Check-in</title>
</head>

<body>

    <!-- Checkout Section-->

    <section class="testimonial pt-5" id="testimonial">
        <div class="container">
            <div class="row ">
                <div class=" col-md-4 py-4 text-white text-center ">
                    <div class="rounded-left " id="left-side">
                        <div class="card-body">

                            <img src="img/lightparking.png" width="50" height="50" alt="logo">

                            <h2 class="pb-5 font-weight-bold" id="sign-head">
                                CHECK-IN
                            </h2>
                            <p class="py-5 font-italic">Bringing tomorrow, today.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 py-4 border-0">
                    <h4 class="pb-4 "><?php echo $Check_In->heading; ?></h4>
                    <h2 class="pb-2 "><?php echo $Check_In->subheading; ?></h2>
                    <?php $Check_In->printoptions(); ?>
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

    <!-- Saving User Selections -->
    <?php if ($_GET['page'] > 0) $Check_In->saveSelections($_GET['page'], $_GET['selection']); ?>

    <!-- If a booking occurs successfully -->
    <?php if ($_GET['page'] > 4) header("refresh:3; url=check-in.php") or die(); ?>
<?php
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    include_once "inc/footer.inc.php";
/*-------------------------------------------------------------------------------------*/
?>