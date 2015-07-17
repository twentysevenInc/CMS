<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../include/general.php");
include("../include/database.php");
if(!checkLogin()){
	header("Location: login.html");
}

$id = $_POST['id'];

$db = new Database;

$servername = $db->dbHost;
$username = $db->dbUser;
$password = $db->dbPass;
$dbname = $db->db;

$conn = new mysqli($servername, $username, $password, $dbname);

$stmt = $conn->prepare("DELETE FROM `service` WHERE id=?");
$stmt->bind_param("i",$id);

$stmt->execute();
?>