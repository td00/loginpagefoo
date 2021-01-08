
<html>
<head>
<title>Secure Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Please <a href="login.php">login</a>');
}
$username = $_SESSION['username'];
echo "Hi ".$username."!";
?>
<br><br>
<a href="profile.php"><button class="btn btn-primary">Profile</button></a>
<br><br><br><br>
<a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>
</body>
</html>
