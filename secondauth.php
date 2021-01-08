<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');

function random_string() {
    if(function_exists('random_bytes')) {
    $bytes = random_bytes(16);
    $str = bin2hex($bytes); 
    } else if(function_exists('openssl_random_pseudo_bytes')) {
    $bytes = openssl_random_pseudo_bytes(16);
    $str = bin2hex($bytes); 
    } else if(function_exists('mcrypt_create_iv')) {
    $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
    $str = bin2hex($bytes); 
    } else {
   //this should be a unique string. if we use this in prod we should change this.
    $str = md5(uniqid('thisisnotreallyrandombutthisstringheresomakethislongandmaybewith12345numberskthxbye', true));
    } 
    return $str;
   }

   $passwordcode = random_string();
   $statement = $pdo->prepare("UPDATE users SET passwordcode = :passwordcode, passwordcode_time = NOW() WHERE id = :userid");
   $result = $statement->execute(array('passwordcode' => sha1($passwordcode), 'userid' => $user['id']));
   

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
        die('successfull. please wait. youll be forwarded! <meta http-equiv="refresh" content="0; URL=passwordchange.php">');
    } else {
        $errorMessage = "somethings wrong (maybe wrong password or invalid session)<br>";
    }
    
}
?>
<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>2nd Auth</title>    
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

 <script src="ressources/js/bootstrap.min.js"></script>
<h3 class="display-5">You want to change your password? Please prove that you know your old password first!</h5>
<form action="?login=1" method="post">
<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" size="40" id="username" placeholder="Username" name="username" ><br><br>
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
</body>
</html>
