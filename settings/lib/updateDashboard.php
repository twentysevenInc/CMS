<?php

include('/var/www/cms/include/database.php');
include('/var/www/cms/include/error.php');
include('/var/www/cms/include/general.php');

if(!checkLogin()){
	header("Location: login.html");
}

$json = json_decode($_POST['data']);
// echo $_POST['data'];

foreach($json->data as $dt)
{
	$index = $dt->index;
	$id = $dt->id;

	$dat = new Database;
	$conn = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);
	$stmt = $conn->prepare("UPDATE `cms-userDashboard` SET position=? WHERE widgetId=? AND userId=?");
	$stmt->bind_param("iii", $index, $id, $_SESSION['id']);
	$stmt->execute();
}

?>