
<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Register</title>    
  <link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   

</head> 
<body>
 
<?php
$showFormular = true;



if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $username = $_POST['username'];
    $givenName = $_POST['givenName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    //regexes for passvalidation:
    $REuppercase = preg_match('@[A-Z]@', $password);
    $RElowercase = preg_match('@[a-z]@', $password);
    $REnumber    = preg_match('@[0-9]@', $password);
    $REspecialChars = preg_match('@[^\w]@', $password);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger" role="alert">Please use valid email</div><br>';
        $error = true;
    }     
    if(strlen($password) == 0) {
        echo '<div class="alert alert-danger" role="alert">Please enter password</div><br>';
        $error = true;
    }
    if($password != $password_confirm) {
        echo '<div class="alert alert-danger" role="alert">passwords doesnt match</div><br>';
        $error = true;
    }
    if(!$REuppercase || !$RElowercase || !$REnumber || !$REspecialChars || strlen($password) < 8) {
        echo '<div class="alert alert-warning" role="alert">Password needs to be more complex.<br />';
        echo '<i>Please implement at least 8 chars, upper & downer caser, one number & one special char.</i></div><br />';
        $error = true;
    }
    

    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo '<div class="alert alert-danger" role="alert">already a user here</div><br>';
            $error = true;
        }    
    }

    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'already a user here<br>';
            $error = true;
        }    
    }
    
    if(!$error) {    
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO users (email, username, givenName, activated, lastName, password) VALUES (:email, :username, :givenName, :activated, :lastName, :password)");
        $result = $statement->execute(array('email' => $email, 'username' => $username, 'givenName' => $givenName, 'lastName' => $lastName, 'password' => $password_hash));
        
        if($result) {        
            echo '<div class="alert alert-success" role="alert">successfull registered. <a href="login.php">Login</a></div><meta http-equiv="refresh" content="1; URL=login.php">';
            $showFormular = false;
        } else {
            echo 'Error. Please try again!<br>';
        }
    } 
}
 
if($showFormular) {
?>
<script src="ressources/js/bootstrap.min.js"></script>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
<form action="?register=1" method="post">

<div class="form-group">
<label for="email">Email address</label>
<input type="email" class="form-control" size="40" id="email" placeholder="invalid@example.com" name="email">
</div>

<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" size="40" id="username" placeholder="Username" name="username">
</div>

<div class="form-group">
<label for="givenName">Given Name</label>
<input type="text" class="form-control" size="40" id="givenName" placeholder="Martha" name="givenName">
</div>
<input type="hidden" id="activated" name="activated" value="0">
<div class="form-group">
<label for="lastName">Family Name</label>
<input type="text" class="form-control" size="40" id="lastName" placeholder="Musterfrau" name="lastName">
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" size="40" id="password" placeholder="Please enter password" name="password">
</div>

<div class="form-group"> 
<label for="password_confirm">Password (again):</label>
<input type="password" class="form-control" id="password_confirm" size="40" name="password_confirm" placeholder="Please confirm password">
</div>
 
<button type="submit" class="btn btn-primary">Register</button>

</form>
 </div></div>
<?php
} 
?>
 
</body>
</html>
