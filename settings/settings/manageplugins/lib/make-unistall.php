<?php

// delete cms-widget
// delete cms-plugin
// delete cms-groupEnablesPlugin
// delete .plugin folder

include('../../../../include/general.php');
include('../../../../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

function rm($path) {
 	$files = glob($path . '/*');
	foreach ($files as $file) {
		is_dir($file) ? rm($file) : unlink($file);
	}
	rmdir($path);
 	return;
}

$plugin = $_POST['name'];

$dat = new Database;
$conn = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);

// delete cms-groupEnablesPlugin
$stmt = $conn->prepare("DELETE FROM `cms-groupEnablesPlugin` WHERE pluginId=(SELECT id FROM `cms-plugin` WHERE name=? )");
$stmt->bind_param("s", $plugin);
$stmt->execute();

// delete cms-widget
$stmt = $conn->prepare("DELETE FROM `cms-widget` WHERE pluginId=(SELECT id FROM `cms-plugin` WHERE name=? )");
$stmt->bind_param("s", $plugin);
$stmt->execute();

// delete cms-plugin
$stmt = $conn->prepare("DELETE FROM `cms-plugin` WHERE name=?");
$stmt->bind_param("s", $plugin);
$stmt->execute();

// delete .plugin Folder
if (file_exists("../../../../plugins/".$plugin.".plugin")) {
	rm("../../../../plugins/".$plugin.".plugin");
}

echo "{'return':'Uninstalled'}";

?>
