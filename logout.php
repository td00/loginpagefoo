
<html>
<head>
<title>Logout</title>
<meta http-equiv="refresh" content="3; URL=login.php">
</head>
<body>
<?php
session_start();
session_destroy();
 
echo "Logout. Session is now destroyed. Now lets go to the login page.";

?>
</body>
</html>