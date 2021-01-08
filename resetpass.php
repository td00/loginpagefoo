<?php
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
 
if(!isset($_GET['userid']) || !isset($_GET['code'])) {
 die("No code delivered. nothing to do here.");
}
 
$userid = $_GET['userid'];
$code = $_GET['code'];
 

$statement = $pdo->prepare("SELECT * FROM users WHERE id = :userid");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();
 
//check if theres a code for the user delivered
if($user === null || $user['passwordcode'] === null) {
 die("No User matching your request.");
}
 
if($user['passwordcode_time'] === null || strtotime($user['passwordcode_time']) < (time()-24*3600) ) {
 die("Ooops. This code isn't valid anymore.");
}
 
 

if(sha1($code) != $user['passwordcode']) {
 die("Thats not your code. Naughty user!");
}
 

 
if(isset($_GET['send'])) {
 $password = $_POST['password'];
 $password_confirm = $_POST['password_confirm'];
 
 if($password != $password_confirm) {
 echo "password or confirmed password wrong";
 } else { 
 $passwordhash = password_hash($password, PASSWORD_DEFAULT);
 $statement = $pdo->prepare("UPDATE users SET password = :passwordhash, passwordcode = NULL, passwordcode_time = NULL WHERE id = :userid");
 $result = $statement->execute(array('passwordhash' => $passwordhash, 'userid'=> $userid ));
 
 if($result) {
 die('Changed password. Please goto <a href="login.php">login</a> now.');
 }
 }
}
?>
 
<h1>Set new password</h1>
<form action="?send=1&amp;userid=<?php echo htmlentities($userid); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">
Please enter new password:<br>
<input type="password" name="password"><br><br>
 
Confirm new password:<br>
<input type="password" name="password_confirm"><br><br>
 
<input type="submit" value="save change">
</form>