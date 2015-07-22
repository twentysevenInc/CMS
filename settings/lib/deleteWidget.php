<?php
include('../../include/general.php');
include('../../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

$db = new Database;

$dat = new Database;
$conn = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);
$stmt = $conn->prepare("DELETE FROM `cms-userDashboard` WHERE userid=? AND widgetid=? AND position=?");
$stmt->bind_param("iii", $_SESSION['id'], $_POST['data'], $_POST['pos']);
$stmt->execute();
echo "{'result': 'success'}\n";
echo "Deleting: id=".$_POST['data']." pos=".$_POST['pos'];

?>
