<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Register</title>    
</head> 
<body>
 
<?php
$showFormular = true;
 
if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $givenName = $_POST['givenName'];
    $lastName = $_POST['lastName'];
    $passwort = $_POST['passwort'];
    $passwort_confirm = $_POST['passwort_confirm'];
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Please use valid email<br>';
        $error = true;
    }     
    if(strlen($passwort) == 0) {
        echo 'Please enter password<br>';
        $error = true;
    }
    if($passwort != $passwort_confirm) {
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
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO users (email, vorname, nachname, passwort) VALUES (:email, :givenName, :lastName, :passwort)");
        $result = $statement->execute(array('email' => $email, 'givenName' => $givenName, 'lastName' => $lastName, 'passwort' => $passwort_hash));
        
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
 
<form action="?register=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
Given Name:<br>
<input type="text" size="40" name="givenName"><br><br>
Family Name:<br>
<input type="text" size="40" name="lastName"><br><br>
Password:<br>
<input type="password" size="40"  name="passwort"><br>
 
Password (aganin):<br>
<input type="password" size="40" name="passwort_confirm"><br><br>
 
<input type="submit" value="GO">
</form>
 
<?php
} 
?>
 
</body>
</html>
