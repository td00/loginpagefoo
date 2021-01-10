
<html>
<head>
<title>Admin Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
include 'db.inc.php';
$username = $_SESSION['username'];

$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$result = $statement->execute(array('username' => $username));
$user = $statement->fetch();
$_SESSION['userid'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['username'] = $user['username'];
$_SESSION['givenName'] = $user['givenName'];
$_SESSION['lastName'] = $user['lastName'];
$_SESSION['activated'] = $user['activated'];
$_SESSION['updated_at'] = $user['updated_at'];
$_SESSION['isadmin'] = $user['isadmin'];

if($_SESSION['isadmin'] == 0) {
    die ('No rights for you! <meta http-equiv="refresh" content="0; URL=logout.php">');
}
echo '<div class="alert alert-danger" role="alert">heres the admin world</div>';

$showForm = true;
 
if(isset($_GET['user']) ) {
 if(!isset($_POST['username']) || empty($_POST['username'])) {
 $error = "<b>Enter the username</b>";
 } else {
 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
 $result = $statement->execute(array('username' => $_POST['username']));
 $user = $statement->fetch(); 
 
 if($user === false) {
 $error = "<b>no user found</b>";
 } else {


 //check if theres a code already
 $statement = $pdo->prepare("UPDATE users SET isadmin = '1' WHERE id = :userid");
 $result = $statement->execute(array('userid' => $user['id']));
 


 $showForm = false;
 }
 }
}
 
if($showForm):
?>
 
<h1>Give Admin Rights!</h1>
Please enter the username below.<br><br>
 
<?php
if(isset($error) && !empty($error)) {
 echo $error;
}
?>
 <script src="ressources/js/bootstrap.min.js"></script>
<form action="?user=1" method="post">
<div class="form-group">
<label for="email">Username</label>
<input type="text" name="email" id="email" class="form-control" value="<?php echo isset($_POST['username']) ? htmlentities($_POST['username']) : ''; ?>"><br>
</div>
<button type="submit" class="btn btn-primary">Search User</button>
</form>
 
<?php
endif; 
?>
<?php
echo '<br /> <br />';
echo '<a href="adminarea.php"><button class="btn btn-info">Back</button></a>';
?>
