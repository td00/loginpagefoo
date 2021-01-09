<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>Activate</title>    
</head> 
<body>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
 
if(!isset($_GET['userid']) || !isset($_GET['code'])) {
 die('<div class="alert alert-warning" role="alert">No code delivered. nothing to do here.</div>');
}
 
$userid = $_GET['userid'];
$code = $_GET['code'];
 

$statement = $pdo->prepare("SELECT * FROM users WHERE id = :userid");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();
 
//check if theres a code for the user delivered
if($user === null || $user['activationcode'] === null) {
 die('<div class="alert alert-danger" role="alert">
 No User matching your request.</div>');
}
 
if($user['activationcode_time'] === null || strtotime($user['activationcode_time']) < (time()-24*3600) ) {
 die('<div class="alert alert-danger" role="alert">
 Ooops. This code isnt valid anymore.</div>');
}
 
 

if(sha1($code) != $user['activationcode']) {
 die('<div class="alert alert-danger" role="alert">
 Not the valid activationcode!</div>');
}
 
if(isset($_GET['send'])) {
  $statement = $pdo->prepare("UPDATE users SET activated = 1, activationcode = NULL, activationcode_time = NULL WHERE id = :userid");
 $result = $statement->execute(array('userid'=> $userid ));
 
 if($result) {
 die('Activated. Going to <a href="secure.php">secure</a> now.<meta http-equiv="refresh" content="1; URL=update.php?page=secure.php">');
 }
}
?>
  <script src="ressources/js/bootstrap.min.js"></script>
<h1>Activate your user</h1>
<form action="?send=1&amp;userid=<?php echo htmlentities($userid); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">
<div class="form-group">
 <button type="submit" class="btn btn-success">Activate</button>
</form>