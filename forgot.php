<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
 
if(isset($_GET['login'])) {
    $email = $_POST['email'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
        
    if ($user !== true ) {
        die('successfull. check your inbox.');
    } else {
        $errorMessage = "somethings wrong (maybe wrong email?)<br>";
    }
    
}
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Forgot Password</title>    
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
 
<form action="?login=1" method="post">
Your E-Mail Adress:<br>
<input type="text" size="40" maxlength="250" name="email"><br><br>
 

 
<input type="submit" value="GO">
</form> 
<a href="login.php">i know my password again!</a>
</body>
</html>
