<?php
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Login POC</title>


    <link href="ressources/css/bootstrap.min.css" rel="stylesheet">
    <link href="ressources/css/start.css" rel="stylesheet">
  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Crappy Login POC</h5>
      <nav class="my-2 my-md-0 mr-md-3">

        <a class="p-2 text-dark" href="https://github.com/td00/loginpagefoo">Git</a>
        <a class="p-2 text-dark" href="register.php">Register</a>
      </nav>
      <a class="btn btn-outline-primary" href="login.php">Sign In</a>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">loginpagefoo POC (PHP & MySQL)</h1>
      <p class="lead">Just a crappy POC written in PHP using PHP, HTML & MySQL.</p>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Register</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>If you don't have a user already.</li>
            </ul>
            <a href="register.php"><button type="button" class="btn btn-lg btn-block btn-primary">Sign up for free</button></a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Login</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>If you want to access your profile</li>
            </ul>
            <a href="login.php"><button type="button" class="btn btn-lg btn-block btn-primary">Login</button></a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Reset Password</h4>
          </div>
          <div class="card-body">
              <ul class="list-unstyled mt-3 mb-4">
              <li>When your login details went missing</li>
            </ul>
            <a href="forgotpass.php"<button type="button" class="btn btn-lg btn-block btn-outline-primary">Forgot Password</button></a>
          </div>
        </div>
      </div>
      <h1 class="display-4">This page is using cookies for the Session ID and information. If you continue to use the site, you'll accept this.</h1>
      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="https://web.td00.de/woddle.gif" alt="" >
            <small class="d-block mb-3 text-muted">&copy; NO RIGHTS RESERVED! 2020</small>
          </div>
          <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Password Login</a></li>
              <li><a class="text-muted" href="#">PHP Session</a></li>
              <li><a class="text-muted" href="#">Logout</a></li>
              <li><a class="text-muted" href="#">Forget password</a></li>
              <li><a class="text-muted" href="#">Password complexibility check</a></li>
              <li><a class="text-muted" href="#">More to come</a></li>
            </ul>
          </div>
      
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="https://thiesmueller.de">Me</a></li>
              <li><a class="text-muted" href="https://github.com/td00/loginpagefoo">Git</a></li>
              <li><a class="text-muted" href="https://thiesmueller.de/dsgvo/datenschmutz.html">Privacy</a></li>
              <li><a class="text-muted" href="https://thiesmueller.de/impress/">Imprint</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="ressources/js/bootstrap.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
