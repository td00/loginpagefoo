
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
        $_SESSION['activated'] = $user['activated'];
        die('<div class="alert alert-success" role="alert"> successfull. go to: <a href="secure.php">secure page</a></div> <meta http-equiv="refresh" content="0; URL=secure.php">');
    } else {
        $errorMessage = '<div class="alert alert-danger" role="alert">somethings wrong (maybe wrong password or wrong user)</div><br>';
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
 <div class="jumbotron jumbotron-fluid">
  <div class="container">

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
</div>
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
