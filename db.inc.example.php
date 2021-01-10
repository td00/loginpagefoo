<?php
$mysqlhost = 'localhost';
$dbname = 'usertable';
$dbuser = 'usertable';
$dbpass = 'password';
$pdo = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.'', $dbuser , $dbpass);
//$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
?>

