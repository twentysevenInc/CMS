<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

$db = new Database;
$result = $db->query('SELECT width, height FROM `cms-widget` WHERE id= \''.$_POST['id'].'\'');
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	// echo $row['width'].' - '.$row['width'];
	$res = $db->query('SELECT position FROM `cms-userDashboard` WHERE userid="'.$_SESSION['id'].'" ORDER BY position DESC LIMIT 1');
	$pos = ((int)mysql_fetch_array($res, MYSQL_ASSOC)['position'])+1;
	$db->query('INSERT INTO `cms-userDashboard` (userid, widgetid, position, width, height)
		VALUES('.$_SESSION['id'].', '.$_POST['id'].', '.$pos.', '.$row['width'].', '.$row['height'].')');
	echo "{'result':'success'}";
}

?>