<?php
//this just prints Session data line for line. Its just a quick page to check if everythings in place
session_start();
echo $_SESSION['userid'];
echo "<br />";
echo $_SESSION['username'];
echo "<br />";
echo $_SESSION['email'];
echo "<br />";
echo $_SESSION['givenName'];
echo "<br />";
echo $_SESSION['lastName'];
echo "<br />";
echo $_SESSION['activated'];
echo "<br />";
echo $_SESSION['updated_at'];
echo "<br />";
echo $_SESSION['isadmin'];

?>