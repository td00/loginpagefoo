<?php
include 'backgroundupdate.php';
echo "freshly updated the session data<br />";
if(isset($_GET['page'])) {
    echo "Going to ".$_GET['page'];
    echo '<meta http-equiv="refresh" content="0; URL='.$_GET['page'].'">';
} else {
    die();
}
?>