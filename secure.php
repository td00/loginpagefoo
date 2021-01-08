<html>
<head>
<title>Secure Page</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
if(!isset($_SESSION['userid'])) {
    die('Please <a href="login.php">login</a>');
}
 
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useremail = $_SESSION['email'];
$usergn = $_SESSION['givenName'];
$userln = $_SESSION['lastName'];
 
echo "Hi ".$username;
echo "<br/>";
echo "Your User-ID is: ".$userid;
echo "<br/>";
echo "Your full name is: ".$usergn." ".$userln;
echo "<br/>";
echo "And your email is: ".$useremail;
echo "<br/>";
echo "You can logout <a href="logout.php">here</a>";
echo "<br />";
echo "<br/>";
echo "This is the end now!";
echo "<br />";
echo "goodbye";
?>
<a href="logout.php"><button>LOGOUT</button></a>
</body>
</html>