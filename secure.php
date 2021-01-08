<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Please <a href="login.php">login</a>');
}
 
$userid = $_SESSION['userid'];
 
echo "Hi ".$userid;
echo "<br/>"
echo "This is secure now!"
?>