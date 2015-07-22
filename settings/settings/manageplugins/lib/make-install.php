<?php
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

$info = json_decode($_POST['data'], true);

$name = $info["name"];
$author = $info["author"];
$version = $info["version"];
$visible = $info["visible"];
$pushid = 0;

$dat = new Database;

// insert plugin info into db
$conn = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);
$stmt = $conn->prepare("INSERT INTO `cms-plugin` (name, author, version, pushId, visible) VALUES(?,?,?,?,?)");
$stmt->bind_param("sssii", $name, $author, $version, $pushid, $visible);
$stmt->execute();

$lid = $stmt->insert_id;

// insert widget info into db
foreach ($info["widgets"] as $w) {
	$wname = $w["name"];
	$reload = $w["reload"];
	$width = $w["width"];
	$height = $w["heigth"];

	$con = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);
	$stm = $con->prepare("INSERT INTO `cms-widget` (name, pluginId, reload, width, height) VALUES(?,?,?,?,?)");
	$stm->bind_param("siiii", $wname, $lid, $reload, $width, $height);
	$stm->execute();
}

// insert settings ???

// move plugin to folder
if (file_exists("../../../../plugins/".$name.".plugin")) {
	rm("../../../../plugins/".$name.".plugin");
}
rename("../tmp/".$name.".plugin", "../../../../plugins/".$name.".plugin");
// rm("../../../../plugins/".$name.".plugin");

echo '{"type":1, "message":"Plugin created!"}';

?>
