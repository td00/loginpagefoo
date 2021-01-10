
<html>
<head>
<title>Activated Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
if($_SESSION['activated'] == 0) {
    die ("Not activated yet")
}
echo "heres the fun world"
?>