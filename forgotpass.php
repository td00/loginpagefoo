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
 if(!isset($_POST['email']) || empty($_POST['email'])) {
 $error = "<b>Enter your email address</b>";
 } else {
 $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 $result = $statement->execute(array('email' => $_POST['email']));
 $user = $statement->fetch(); 
 
 if($user === false) {
 $error = "<b>no user found</b>";
 } else {
 //check if theres a code already
 $passwordcode = random_string();
 $statement = $pdo->prepare("UPDATE users SET passwordcode = :passwordcode, passwordcode_time = NOW() WHERE id = :userid");
 $result = $statement->execute(array('passwordcode' => sha1($passwordcode), 'userid' => $user['id']));
 
 $mailrcpt = $user['email'];
 $mailsubject = "New password for your User";
 $from = "From: Password Reset Service <resetmypw@invalid.example.com>"; //place a real address if we use this in production
 $url_passwordcode = 'https://loginpagefoo.td00.de/resetpass.php?userid='.$user['id'].'&code='.$passwordcode; //this shouldnt be my domain in prod..
 $text = 'Hallo '.$user['username'].',
please use the following URL to change your password in the next 24h:
'.$url_passwordcode.'
 
If this mail comes unsolicited, please just ignore the mail.
 
cheers
loginpagefoo script';
 
 mail($mailrcpt, $mailsubject, $text, $from);
 
 echo "Link send."; 
 $showForm = false;
 }
 }
}
 
if($showForm):
?>
 
<h1>Forgot Password</h1>
Please enter your email so we can send you a link to reset your password.<br><br>
 
<?php
if(isset($error) && !empty($error)) {
 echo $error;
}
?>
 
<form action="?send=1" method="post">
E-Mail:<br>
<input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlentities($_POST['email']) : ''; ?>"><br>
<input type="submit" value="New Password">
</form>
 
<?php
endif; 
?>