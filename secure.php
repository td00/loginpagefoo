<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
if(!isset($_SESSION['userid'])) {
    die('Please <a href="login.php">login</a>');
}
 
$userid = $_SESSION['userid'];
 
echo "Hi ".$userid;
echo "<br/>";
echo "<br/>";
echo "<br/>";
$statement = $pdo->prepare("SELECT * FROM users WHERE id = $userid");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

echo $email;
echo "<br/>";
echo "<br/>";
echo "<br/>";

echo "This is secure now!";
?>
