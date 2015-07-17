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
	// $conn = new PDO('mysql:dbname='.$dbname.';host='.$servername, $dbUser, $dbPass);

	if(isset($_POST['name'])){
		$name = trim($_POST['name']);
		$id = $_SESSION['id'];
		if(!empty($name)){

			// $addQuery = $conn->prepare("
			// 	INSERT INTO todo (name, user, done) 
			// 	VALUES (:name, :user, 0) 
			// 	");
			// $addQuery->execute([
			// 		'name' => $name,
			// 		'user' => $_SESSION['id']
			// 	]);

			$addQuery = $conn->prepare("
				INSERT INTO todo (name, user, done) 
				VALUES (?, ?, 0) 
				");
			$addQuery->bind_param("ss", $name, $id);
			$addQuery->execute();
		}
	}
	header('Location: /cms/index.php');
?>