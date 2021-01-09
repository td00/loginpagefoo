<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
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

if(isset($_GET['register'])) {
echo 'Session newly validated. Going back to secure land! <meta http-equiv="refresh" content="0; URL=secure.php">';
}if(isset($_GET['profile'])) {
    echo 'Session newly validated. Going back to profile land! <meta http-equiv="refresh" content="0; URL=profile.php">';
}if(isset($_GET['rawdata'])) {
    echo 'Session newly validated. Going back to secure land! <meta http-equiv="refresh" content="0; URL=rawdata.php">';
}else {
    echo 'Session newly validated. I dont know where i shoudl go! Defaulting to secure! <meta http-equiv="refresh" content="0; URL=secure.php">';
}

?>