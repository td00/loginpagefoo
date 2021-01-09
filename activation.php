<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>Activate User</title>    
</head> 
<body>
<?php 
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
 
 
$showForm = true;
 
if(isset($_GET['send']) ) {
 if(!isset($_POST['username']) || empty($_POST['username'])) {
 $error = "<b>Enter your Username</b>";
 } else {
 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
 $result = $statement->execute(array('username' => $_POST['username']));
 $user = $statement->fetch(); 
 
 if($user === false) {
 $error = "<b>no user found</b>";
 } else {
 //check if theres a code already
 $activationcode = random_string();
 $statement = $pdo->prepare("UPDATE users SET activationcode = :activationcode, activationcode_time = NOW() WHERE id = :userid");
 $result = $statement->execute(array('activationcode' => sha1($activationcode), 'userid' => $user['id']));
 
 $mailrcpt = $user['email'];
 $mailsubject = "Activate the Account of ".$user['username'];
 $from = "From: Account Activation Service <activatemyaccount@loginpagefoo.td00.de>"; //place a real address if we use this in production
 $url_activationcode = 'https://loginpagefoo.td00.de/activate.php?userid='.$user['id'].'&code='.$activationcode; //this shouldnt be my domain in prod..
 $text = 'Hallo '.$user['username'].',
please use the following URL to activate your account in the next 24h:
'.$url_activationcode.'
 
If this mail comes unsolicited, please just ignore the mail.
 
cheers
loginpagefoo script';
 
 mail($mailrcpt, $mailsubject, $text, $from);
 
 echo 'Link send. Going back to <a href="profile.php">profile</a> page. <meta http-equiv="refresh" content="0; URL=profile.php">'; 
 $showForm = false;
 }
 }
}
 
if($showForm):
?>
 
<h1>Activate user</h1>
Please enter your username so we can send you a link to activate your account.<br><br>
 
<?php
if(isset($error) && !empty($error)) {
 echo $error;
}
?>
 <script src="ressources/js/bootstrap.min.js"></script>
<form action="?send=1" method="post">
<div class="form-group">
<label for="username">Username</label>
<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($_POST['username']) ? htmlentities($_POST['username']) : ''; ?>"><br>
</div>
<button type="submit" class="btn btn-primary">Activate me</button>
</form>
 
<?php
endif; 
?>