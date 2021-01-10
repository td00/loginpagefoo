
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
echo '<a href="adminarea_admins_give.php"><button class="btn btn-success">GIVE</button></a>';
echo '<a href="adminarea_admins_take.php"><button class="btn btn-danger">TAKE</button></a>';
echo '<br /> <br />';
echo '<a href="adminarea.php"><button class="btn btn-info">Back</button></a>';
?>
