<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

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
