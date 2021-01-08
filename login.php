<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
 
if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['givenName'] = $user['givenName'];
        $_SESSION['lastName'] = $user['lastName'];
        die('successfull. go to: <a href="secure.php">secure page</a>');
    } else {
        $errorMessage = "somethings wrong (maybe wrong password or wrong email)<br>";
    }
    
}
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title>    
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
 
<form action="?login=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
 
Your password:<br>
<input type="password" size="40" name="password"><br>
 
<input type="submit" value="GO">
</form> 
</body>
</html>
