<?php
include('../include/general.php');
include('../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

echo $_POST['cms'];

?>

