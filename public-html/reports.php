<?php
/*===================================== Home Page =====================================*/
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    require_once "inc/header.inc.php";
    require CLASSES . "report.class.php";
    $Report = new Report($_GET['type'], $_GET['filter']);
/*-------------------------------------------------------------------------------------*/
?>

<head>
    <title>Parking Space Car Parking Systems</title>
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
                                <img src="img/jeep.png" width="50" height="50" alt="logo">

                                <h2 class="text-center font-weight-bold ">REPORTS</h2>
                                <p class="font-italic"><?php $Report->printReportHeading(); ?></p>

                            </div>


                            <!-- Table -->
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <?php $Report->printTableHeading(); ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $Report->printTableData(); ?>
                                </tbody>
                            </table>

                            <p class="font-italic">
                                <a class="navbar-brand" href="index.php">
                                    <img src="img/back.png" width="30" height="30" alt="logo">
                                </a><small>Go back to <a href="index.php" id="signup">Homepage</small></a>
                            </p>

                            </form>

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