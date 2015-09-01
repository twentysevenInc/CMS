<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}


$dat = new Database;
// $result = $db->query("SELECT username FROM cms_login WHERE password='".hash('sha512', $_POST['old-password'])."' AND username='".$_POST['username']."'");

$conn = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);
$conn->query("SET NAMES 'utf8'");
$stmt = $conn->prepare("SELECT name FROM `cms-user` WHERE pass=? AND name=?");
$pass = hash('sha512', $_POST['old-password']);
$stmt->bind_param("ss", $pass, $_SESSION['user']);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$conn->close();

if(!isset($name)){
	echo '{"type": "error", "message": "Old Password not correct"}';
	return;
}
if(strlen($_POST['new-password']) < 4){
	echo '{"type": "error", "message": "Password too short"}';
	return;
}
if($_POST['new-password'] != $_POST['repeat-password']){
	echo '{"type": "error", "message": "The repeated password is wrong."}';
	return;
}
// $result = $db->query("UPDATE cms_login SET password='".hash('sha512', $_POST['repeat'])."' , gid='".$_POST['group']."' WHERE username='".$_POST['username']."';");

$conn = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);
$conn->query("SET NAMES 'utf8'");
$stmt = $conn->prepare("UPDATE `cms-user` SET pass=? WHERE pass=? AND name=?");
$newPass = hash('sha512', $_POST['new-password']);
$stmt->bind_param("sss", $newPass, $pass, $_SESSION['user']);
$stmt->execute();
$conn->close();

echo '{"type": "success", "message": "Password updated"}';


?>
