
<html>
<head>
<title>Admin Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
if($_SESSION['isadmin'] == 0) {
    die ('No rights for you! <meta http-equiv="refresh" content="0; URL=logout.php">');
}
echo '<div class="alert alert-danger" role="alert">heres the admin world</div>';

echo '<a href="adminarea_useradmin.php"><button class="btn btn-primary">User Admin</button></a>';
echo '<br /> <br />';
echo '<a href="adminarea_sessions.php"><button class="btn btn-primary">Session Admin</button></a>';
echo '<br /> <br />';
echo '<a href="adminarea_admins.php"><button class="btn btn-danger">Admin Admin</button></a>';
echo '<br /> <br />';
echo '<a href="secure.php"><button class="btn btn-info">Back</button></a>';
?>
