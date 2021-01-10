
<html>
<head>
<title>Admin Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
include 'db.inc.php';
$username = $_SESSION['username'];

$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$result = $statement->execute(array('username' => $username));
$user = $statement->fetch();
$_SESSION['userid'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['username'] = $user['username'];
$_SESSION['givenName'] = $user['givenName'];
$_SESSION['lastName'] = $user['lastName'];
$_SESSION['activated'] = $user['activated'];
$_SESSION['updated_at'] = $user['updated_at'];
$_SESSION['isadmin'] = $user['isadmin'];

if($_SESSION['isadmin'] == 0) {
    die ('No rights for you! <meta http-equiv="refresh" content="0; URL=logout.php">');
}

echo '<div class="alert alert-danger" role="alert">heres the admin world</div>';


// Run the query.
$result = $pdo->query("SELECT * FROM table LIMIT 10");

// Get the result in to a more usable format.
$query = array();
while($query[] = mysqli_fetch_assoc($result));
array_pop($query);

// Output a dynamic table of the results with column headings.
echo '<table border="1">';
echo '<tr>';
foreach($query[0] as $key => $value) {
    echo '<td>';
    echo $key;
    echo '</td>';
}
echo '</tr>';
foreach($query as $row) {
    echo '<tr>';
    foreach($row as $column) {
        echo '<td>';
        echo $column;
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';

echo '<br /> <br />';
echo '<a href="adminarea.php"><button class="btn btn-info">Back</button></a>';
?>
