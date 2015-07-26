<?php
include('../../include/general.php');
include('../../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

$db = new Database;
$result = $db->query('SELECT width, height FROM `cms-widget` WHERE id= \''.$_POST['id'].'\'');
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$res = $db->query('SELECT position FROM `cms-userDashboard` WHERE userid="'.$_SESSION['id'].'" ORDER BY position DESC');
	$pos = ((int)mysql_fetch_array($res, MYSQL_ASSOC)['position'])+1;
	$db->query('INSERT INTO `cms-userDashboard` (userid, widgetid, position, width, height)
		VALUES('.$_SESSION['id'].', '.$_POST['id'].', '.$pos.', '.$row['width'].', '.$row['height'].')');
	echo "{'result':'success'}";
	echo 'SELECT position FROM `cms-userDashboard` WHERE userid="'.$_SESSION['id'].'" ORDER BY position DESC';
	echo 'INSERT INTO `cms-userDashboard` (userid, widgetid, position, width, height)
		VALUES('.$_SESSION['id'].', '.$_POST['id'].', '.$pos.', '.$row['width'].', '.$row['height'].')';
}

?>
