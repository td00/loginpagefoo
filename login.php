<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Page</title>

    <!-- Bootstrap core CSS -->
    <link href="ressources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="ressources/css/page.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">loginpagefoo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
             <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Functions</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="profile.php">Profile</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a href="logout.php"><button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Logout</button></a>
        </form>
      </div>
    </nav>

    <main role="main" class="container">

      <div class="starter-template">

<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
 
if(isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();
        
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['givenName'] = $user['givenName'];
        $_SESSION['lastName'] = $user['lastName'];
        die('successfull. go to: <a href="secure.php">secure page</a><meta http-equiv="refresh" content="0; URL=secure.php">');
    } else {
        $errorMessage = "somethings wrong (maybe wrong password or wrong user)<br>";
    }
    
}
?>
<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>Login</title>    
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
 <script src="ressources/js/bootstrap.min.js"></script>
<form action="?login=1" method="post">
<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" size="40" id="username" placeholder="Username" name="username"><br><br>
</div>
 <div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" size="40" id="password" placeholder="Password" name="password"><br>
 </div>
 <button type="submit" class="btn btn-primary">Login</button>
</form> 
<br />
<br />
<a href="forgotpass.php"><button class="btn btn-warning">I forgot my password</button></a>
<br /> <br />
<a href="register.php"><button class="btn btn-info">I need an account first. Please let me register</button></a>

</div>

</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../../../assets/js/vendor/popper.min.js"></script>
<script src="../../../../dist/js/bootstrap.min.js"></script>
</body>
</html>
