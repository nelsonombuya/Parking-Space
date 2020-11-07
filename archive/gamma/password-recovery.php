<!doctype html>
<html lang="en">
  <head>
    <title>Password Recovery</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!--Icon for Title-->
    <link rel="icon" href="jeep.png" type="image/icon type">

  </head>
  <body>

  <header>

<!--Navbar Section-->

     <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
             <a class="navbar-brand" href="#">
                 <img src="jeep.png" width="25" height="25"  alt="logo" class="animate__bounce ">
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


  <!--Password recovery Section-->

  <div class="container-fluid px-0 py-4 mt-4 text-dark ">
  <div class="row">
		<div class="col-md-12 col-md-offset-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                <a class="navbar-brand" href="#">
                 <img src="darkjeep.png" width="50" height="50"  alt="logo">
                </a>
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="glyphicon glyphicon-envelope"></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-dark btn-block" value="Reset Password" type="submit">
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
                              <p class="text-center"><a href="login.php" id="signup">Sign up</a></p>
                           </div>    
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
            </div>




            <div class="container">
          <div class="footer text-secondary text-center">&#169;2020 COPYRIGHT - Nelson, Benjie, Vic.  </div>
        </div>
        











      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>