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


echo 'Session newly validated!<br />';
echo "Going to ".$_GET['page'];
if(isset($_GET['page'])) {
echo '<meta http-equiv="refresh" content="0; URL='.$_GET['page'].'">';
} if($_GET['page'] == "update.php"){
    die();
}else {
    die();
}
?>