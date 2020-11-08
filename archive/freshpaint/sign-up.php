<!doctype html>
<html lang="en">
  <head>
    <title>Sign up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <!--Icon for Title-->
    <link rel="icon" href="img/jeep.png" type="image/icon type">

  </head>
  <body>

  <header>

<!--Navbar Section-->

     <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
             <a class="navbar-brand" href="index.php">
                 <img src="img/jeep.png" width="25" height="25"  alt="logo">
             </a>
             <a class="navbar-brand" href="#">NeoDev</a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="index.php">Home </a>
                <a class="nav-item nav-link" href="#about">About</a>
                <a class="nav-item nav-link" href="#FAQ">FAQ</a>
                <a class="nav-item nav-link" href="#contacts">Contacts</a>
              </div>
             </div>

         </div>
     </nav>
</header>


  <!--Login Section-->

  <section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="row ">
            <div class=" col-md-4 py-4 text-white text-center " >
                <div class="rounded-left " id="left-side">
                    <div class="card-body" >
                    <h2 class="py-4 font-weight-bold" id="sign-head">
                            WELCOME TO
                        </h2>
                    <img src="img/jeep.png" width="50" height="50"  alt="logo">

                        <h2 class="py-4 font-weight-bold" id="sign-head">
                            NeoDev Car Parking System
                        </h2>
                        <p class="pt-5 font-italic">Sign up to enjoy ease of parking with a touch of class.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-4 border-0">
                <h2 class="font-weight-bold">Sign up</h2>
                <h4 class="pb-4 font-italic">Please fill with your details</h4>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <input id="First Name" name="First Name" placeholder="First Name *" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-6">
                        <input id="Last Name" name="Last Name" placeholder="Last Name *" class="form-control" type="text">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <input id="Username" name="Username" placeholder="Username *" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <input id="password" name="password" placeholder="Enter Password *" class="form-control "  type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <input id="password" name="email" placeholder="Confirm Password *" class="form-control "  type="password">
                        </div>
                      </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-check">
                                  <label class="form-check-label" for="invalidCheck2">
                                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>

                                    <small>By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>

                                  </label>
                                  
                                </div>
                              </div>
                    
                          </div>
                    </div>
                    
                    <div class="form-row">
                        <button type="button" class="btn btn-dark">Submit</button>
                    </div>
                    <div class="form-group">
                              <p class="text-center py-4">Already have an account? <a href="login.php" id="signup">Login here</a></p>
                           </div>

                </form>
            </div>
        </div>
    </div>
</section>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>