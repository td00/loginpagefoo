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
    die('Please <a href="login.php">login</a>');
}
 
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useremail = $_SESSION['email'];
$usergn = $_SESSION['givenName'];
$userln = $_SESSION['lastName'];
 
echo "Profile of ".$username;
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

<br>

<br/>
<br>
<a href="secure.php"><button class="btn btn-info">Back</button></a>
<br/>
<br>

<br/>

<br/>

<a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>
</body>
</html>