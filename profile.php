
<html>
<head>
<title>Profile Page</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('<div class="alert alert-primary" role="alert">Please <a href="login.php">login</a></div><meta http-equiv="refresh" content="2; URL=login.php">');
}
 
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useremail = $_SESSION['email'];
$usergn = $_SESSION['givenName'];
$userln = $_SESSION['lastName'];
$activated = $_SESSION['activated'];
 
echo '<div class="alert alert-info" role="alert">Profile of '.$username.'</div>';
echo "<br/>";
echo '<table class="table table-dark table-striped" style="width:30%">';
echo "<tr>";
echo "<td>";
echo "Username";
echo "</td>";
echo "<td>";
echo $username;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "User-ID";
echo "</td>";
echo "<td>";
echo $userid;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "given Name";
echo "</td>";
echo "<td>";
echo $usergn;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "lastName";
echo "</td>";
echo "<td>";
echo $userln;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "E-Mail";
echo "</td>";
echo "<td>";
echo $useremail;
echo "</td>";
echo "</tr>";
?>
</table>
<br /> <br /><br />
<table class="table table-dark table-striped" style="width:30%">
<?php
echo "<tr>";
echo "<td>";
echo "User Status:";
echo "</td>";
echo "<td>";
if ($activated == 0) {
    echo '<p class="text-danger">Not Activated!</p><br>';
    echo 'Click <a href="activation.php">here</a> to activate';
}
if ($activated == 1) {
    echo '<p class="text-success">Activated!</p>';
}
echo "</td>";
echo "</tr>";
?>
</table>
<br>

<br/>
<br>
<a href="secure.php"><button class="btn btn-info">Back</button></a>
<br/>
<br>
<a href="rawdata.php"><button class="btn btn-black">Raw Data</button></a>
<br/>

<br/>

<a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>
</body>
</html>
