<?php   // Includes
    require "Includes/Configuration/Connection.php";
    require "Includes/Configuration/Session.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Parking Space</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="Pages\Main Page\Code\CSS\New Style.css">

    <!--Icon for Title-->
    <link rel="icon" href="Includes\Media\Images\Jeep (Inverted).png" type="image/icon type">
</head>

<body>
    <header>
        <!--Navbar Section-->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top ">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="Includes\Media\Images\Jeep (Inverted).png" width="25" height="25" alt="Logo"
                        class="animate__bounce ">
                </a>
                <a class="navbar-brand" href="#">Parking Space</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link" href="#">Home </a>
                        <a class="nav-item nav-link" href="#about">About</a>
                        <a class="nav-item nav-link" href="#FAQ">FAQ</a>
                        <a class="nav-item nav-link" href="#contacts">Contacts</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <!--Main Menu-->
        <div class="container-fluid banner ">
            <h2 class="display-4 py-4 text-center text-light">CAR PARKING SYSTEM</h2>
            <p class="lead text-center text-white font-weight-bolder pb-4"><strong>Would you like to open the terminal,
                    or manage your account?</strong></p>

            <div class="container">
                <div class="card-deck">
                    <div class="card text-center text-white mb-3">
                        <a class="terminal-link text-white text-decoration-none" href="Pages/Terminal/Terminal.php">
                            <img src="Includes\Media\Images\Parking.png" class="img-thumbnail" alt="Parking Terminal">
                            <div class="card-body">
                                <p>Parking Terminal</p>
                            </div>
                        </a>
                    </div>
                    <div class="card text-center text-white mb-3 border-0">
                        <a class="checkout-link text-white text-decoration-none" href="Pages/Checkout/Checkout.php">
                            <img src="Includes\Media\Images\Checkout.png" class="img-thumbnail" alt="Checkout Terminal">
                            <div class="card-body">
                                <p>Checkout Terminal</p>
                            </div>
                        </a>
                    </div>
                    <div class="card text-center text-white mb-3">
                        <a class="account-link text-white text-decoration-none" href="Pages\Login\Code\PHP\Login.php">
                            <img src="Includes\Media\Images\User.png" class="img-thumbnail" alt="Account Management">
                            <div class="card-body">
                                <p>Account Management</p>
                            </div>
                        </a>
                    </div>



                </div>

            </div>



            <!--Section B-->
            <div class="container-fluid px-0 text-white ">
                <section class="divider py-5 bg-dark">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 text-right pr-5 pb-4">
                            <h2 class="font-weight-bolder ">Our Vision</h2>
                        </div>
                        <div class="col-md-4 ">
                            <p class="text-muted">We want to live in a world where all minor tasks are <br>
                                automated to make life easier for mankind. This <br>
                                will free up our mind to do so much more for the sky is the limit.
                            </p>
                        </div>
                    </div>
                </section>
            </div>


            <!--About Section-->
            <section id="about" class="text-center text-white pb-4">
                <h2 class="display-4 pt-4 text-center text-white">ABOUT US</h2>
                <p class="lead text-center pb-4 text-primary">Know more about the product and the producers</p>

                <div class="row justify-content-center align-items-center">
                    <div class="col-md-4 text-right">
                        <h2>Unhackable systems</h2>
                        <p class="text-muted">
                            We have implemented a number of features to help ensure that your information is
                            safe and secure from unethical hackers.
                        </p>
                        <h2>Fast Access Times</h2>
                        <p class="text-muted">
                            With more compacted databases, we have the power to cut access time by half
                            and increase your productivity in a day by double as you can now access the system
                            and park faster.
                        </p>
                        <h2>Cheaper System</h2>
                        <p class="text-muted">
                            Using Parking Space Car Parking Systems is way more cheaper as it doesnt require hardwares
                            and hard-wired physicall connection installations as if we are back in the 1800s.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <img src="Includes\Media\Images\Organized.jpg" alt="organized" class="img-fluid">
                    </div>
                </div>
            </section>

            <!--Meet The Team-->
            <div class="container-fluid">
                <p class="lead text-center text-white font-weight-bolder pt-4"><strong>MEET THE TEAM</strong></p>
            </div>
            <div class="card-deck text-center py-4">
                <div class="card">
                    <img src="Includes\Media\Profile Pictures\Anonymous User.png"
                        class="card-img-top rounded mx-auto d-block" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Nelson</h5>
                        <p class="card-text"><small class="text-muted">Back-End Development</small></p>
                        <p class="card-text text-white">The man. The Legend himself. Ensures that there is seemless
                            communication between the different factions</p>
                    </div>
                </div>
                <div class="card">
                    <img src="Includes\Media\Profile Pictures\Papi.jpg" class="card-img-top rounded mx-auto d-block"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Benjamin</h5>
                        <p class="card-text"><small class="text-muted">Front-End Development</small></p>
                        <p class="card-text text-white">Here to always keep the site looking hella good. Oshe de baddest
                        </p>
                    </div>
                </div>
                <div class="card">
                    <img src="Includes\Media\Profile Pictures\Anonymous User.png"
                        class="card-img-top rounded mx-auto d-block" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Victor</h5>
                        <p class="card-text"><small class="text-muted">Back-End Development and Documentation</small>
                        </p>
                        <p class="card-tex text-white">Victor is always updating the documentation and keeping the
                            databases fresh and clean.</p>
                    </div>
                </div>
            </div>

            <!--FAQ-->
            <h2 id="FAQ" class="display-4 pt-4 text-center text-white">All your questions answered</h2>
            <p class="lead text-center pb-4 text-primary">Kindly call our hotline and our tech-team will assist you</p>




            <div class="container p-4 text-white">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-decoration-none text-secondary"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    1. Where are you located?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <p>Kabarak University, but we can come through where you are at</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-decoration-none text-secondary"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    2. How can I reach you?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p>Parking Space team can be called on 0725 088 244</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-decoration-none text-secondary"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    3. How can I get this system in my parking lot?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p>We can install it where and when you want</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-decoration-none text-secondary"
                                    data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    4. Does the system lag?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p>Never </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-decoration-none text-secondary"
                                    data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    5. When will the system be ready for public use?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p>When we are done presenting to the panel</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <!--Contacts-->


            <h2 id="contacts" class="display-4 py-2 text-center text-white">How may we help you today?</h2>
            <p class="lead text-center pb-4 text-primary">We are always ready to listen and willing to help</p>

            <div class="container p-4">
                <div class="row">
                    <div class="card mb-3 col-md-8 border-0">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <div id="map-container-google-1" class="z-depth-1-half map-container">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15959.205108501845!2d35.96499!3d-0.16747!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x363c14244dccdde!2sKabarak%20university!5e0!3m2!1sen!2ske!4v1598909457945!5m2!1sen!2ske"
                                        width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                                        aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="card bg-secondary text-white p-3 col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" aria-describedby="emailHint"
                                placeholder="Enter your email">
                            <small id="emailHint" class="form-text">(We shall not share your email with anyone)</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" class="form-control" placeholder="Enter message" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn-4 text-primary">Submit</button>
                    </form>
                </div>
            </div>


            <!--Footer-->


            <div class="row text-white text-center bg-dark pt-4">
                <div class="col-sm-12">

                    <p class="font-weight-light">
                        <ul class="list-unstyled">
                            <li>Parking Space CAR PARKING SYSTEM</li>
                            <li>Digital parking assitance </li>
                            <li>Kabarak University</li>
                            <li>PRIVATE BAG, NAKURU-KENYA</li>
                            <li>Email: info@kabarakuniversity.ac.ke</li>
                            <li>Tel: 0725 088 244 / 0758 466 254 </li>
                            <li>
                                <a class="navbar-brand" href="#">
                                    <img src="Includes\Media\Images\Jeep (Inverted).png" width="25" height="25"
                                        alt="logo">
                                </a>
                            </li>
                        </ul>
                    </p>
                </div>
                <div class="container">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="https://www.facebook.com/theserenityplacerehab/"><img
                                    src="/img/fb.png" width="25"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="/img/twitter.png" width="27"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="/img/insta.png" width="25"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="/img/gmail.png" width="25"></a></li>
                    </ul>
                </div>
                <div class="container">
                    <div class="footer text-secondary">&#169;2020 COPYRIGHT - Nelson, Benjie, Vic. </div>
                </div>

            </div>




    </main>
    <footer>


    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>