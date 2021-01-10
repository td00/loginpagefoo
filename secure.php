
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
$activated = $_SESSION['activated'];
$isadmin = $_SESSION['isadmin'];

echo "Hi ".$username."!";
if(isset($_GET['activation_req'])) {
    echo '<div class="alert alert-danger" role="alert">Your account isnt activated yet!</div><br>';
}
?>
<br><br>
<a href="profile.php"><button class="btn btn-primary">Profile</button></a>
<br><br>
<?php
if ($activated == 0) {
    echo '<a href="?activation_req=1"><button class="btn btn-primary disabled">Activated Area</button></a>';
}
if ($activated == 1) {
    echo '<a href="activatedarea.php"><button class="btn btn-primary">Activated Area</button></a>';
}
?>
<br><br>
<a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>

<br><br><br>
<?php
if ($isadmin == 0) {
    echo '<br>';
}
if ($isadmin == 1) {
    echo '<a href="adminarea.php"><button class="btn btn-danger">Admin Area</button></a>';
}
?>

</body>
</html>
