<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

$plugin = $_POST['plugin'];
$group = $_POST['group'];

$dat = new Database;
$conn = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);
$stmt = $conn->prepare("INSERT INTO `cms-groupEnablesPlugin`(groupId, pluginId) VALUES ((SELECT id FROM `cms-group` WHERE name = ?),(SELECT id FROM `cms-plugin` WHERE name = ?))");
$stmt->bind_param("ss", $group, $plugin);
$stmt->execute();

echo "{'return':'Success!'}";

// goto plugin install page

?>
