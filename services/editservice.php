<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../include/general.php");
include("../include/database.php");
if(!checkLogin()){
	header("Location: login.html");
}

$ip = $_POST['ip'];
$id = $_POST['id'];
$name = $_POST['name'];

$db = new Database;

$servername = $db->dbHost;
$username = $db->dbUser;
$password = $db->dbPass;
$dbname = $db->db;

$conn = new mysqli($servername, $username, $password, $dbname);

$stmt = $conn->prepare("UPDATE `service` SET `ip`=?,`name`=? WHERE id=?");
$stmt->bind_param("ssi", $ip, $name, $id);

$stmt->execute();
header("Location: ../index.php?page=services");
?>