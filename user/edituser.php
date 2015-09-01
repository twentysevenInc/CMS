<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../include/general.php");
include("../include/database.php");
if(!checkLogin()){
	header("Location: login.html");
}

$name = $_POST['username'];
$email = $_POST['email'];
$id = $_POST['id'];

echo $name."\n";
echo $email."\n";
echo $id."\n";

$db = new Database;

$servername = $db->dbHost;
$username = $db->dbUser;
$password = $db->dbPass;
$dbname = $db->db;

$conn = new mysqli($servername, $username, $password, $dbname);

$stmt = $conn->prepare("UPDATE `user` SET `user`.`name`=?,`user`.`email`=? WHERE `user`.`id`=?");
$stmt->bind_param("ssi", $name, $email, $id);

$stmt->execute();
// header("Location: ../index.php?page=profile");
?>
