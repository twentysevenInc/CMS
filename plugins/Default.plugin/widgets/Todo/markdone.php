<?php
	session_start();  
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	$path = $_SERVER['DOCUMENT_ROOT'].'/cms/';

	include($path."include/general.php");
	include($path."include/database.php");

	$db = new Database;
	$servername = $db->dbHost;
	$username = $db->dbUser;
	$password = $db->dbPass;
	$dbname = $db->db;

	$conn = new mysqli($servername, $username, $password, $dbname);

	if(isset($_GET['as'], $_GET['item'])) {
		$as = $_GET['as'];
		$item = $_GET['item'];
		$id = $_SESSION['id'];

		switch ($as) {
			case 'done':
				$query = $conn->prepare("
					UPDATE todo
					SET done = 1
					WHERE id = ? AND user = ?
					");
				$query->bind_param("ss", $item, $id);
				$query->execute();
				break;
			case 'notdone':
				$query = $conn->prepare("
					UPDATE todo
					SET done = 0
					WHERE id = ? AND user = ?
					");
				$query->bind_param("ss", $item, $id);
				$query->execute();
				break;
			case 'delete':
				$query = $conn->prepare("
					DELETE FROM todo
					WHERE id = ? AND user = ?
					");
				$query->bind_param("ss", $item, $id);
				$query->execute();
				break;
		}
	}

	header('Location: /cms/index.php');
?>