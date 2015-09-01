<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

$db = new Database;
$result = $db->query('SELECT width, height FROM `cms-widget` WHERE id= \''.$_POST['id'].'\'');
// echo 'SELECT position FROM `cms-userDashboard` WHERE userid="'.$_SESSION['id'].'" ORDER BY position DESC\n';
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$res = $db->query('SELECT position FROM `cms-userDashboard` WHERE userid='.$_SESSION['id'].' ORDER BY position DESC');
	$arr = mysql_fetch_array($res, MYSQL_ASSOC);
	$pos = ((int)$arr["position"]) + 1;
	$db->query("INSERT INTO `cms-userDashboard` (userid, widgetid, position, width, height) VALUES(".$_SESSION['id'].", ".$_POST['id'].", ".$pos.", ".$row['width'].", ".$row['height'].")");
	// echo "INSERT INTO `cms-userDashboard` (userid, widgetid, position, width, height) VALUES(".$_SESSION['id'].", ".$_POST['id'].", ".$pos.", ".$row['width'].", ".$row['height'].")\n";
	echo "{'result':'success pos:".$pos."'}";
}

?>
