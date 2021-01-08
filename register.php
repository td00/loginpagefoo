<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Register</title>    
  <link rel="stylesheet" href="ressources/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   

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
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Please use valid email<br>';
        $error = true;
    }     
    if(strlen($password) == 0) {
        echo 'Please enter password<br>';
        $error = true;
    }
    if($password != $password_confirm) {
        echo 'passwords doesnt match<br>';
        $error = true;
    }
    

    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'already a user here<br>';
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
        
        $statement = $pdo->prepare("INSERT INTO users (email, username, givenName, lastName, password) VALUES (:email, :username, :givenName, :lastName, :password)");
        $result = $statement->execute(array('email' => $email, 'username' => $username, 'givenName' => $givenName, 'lastName' => $lastName, 'password' => $password_hash));
        
        if($result) {        
            echo 'successfull registered. <a href="login.php">Login</a>';
            $showFormular = false;
        } else {
            echo 'Error. Please try again!<br>';
        }
    } 
}
 
if($showFormular) {
?>
 <script src="ressources/js/bootstrap.min.js"></script>
<form action="?register=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
Username:<br>
<input type="text" size="40" name="username"><br><br>
Given Name:<br>
<input type="text" size="40" name="givenName"><br><br>
Family Name:<br>
<input type="text" size="40" name="lastName"><br><br>
Password:<br>
<input type="password" size="40"  name="password"><br><br>
 
Password (aganin):<br>
<input type="password" size="40" name="password_confirm"><br><br>
 
<input type="submit" value="GO">
</form>
 
<?php
} 
?>
 
</body>
</html>
