<?php
	include('include/database.php');
	include('include/error.php');
	include('include/general.php');

	$dat = new Database;
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$password = hash('sha512', $password);

	// check for SQLi
	$conn = new mysqli($dat->dbHost, $dat->dbUser, $dat->dbPass, $dat->db);
	$stmt = $conn->prepare("SELECT groupId, id, name, avatar FROM user WHERE name=? AND pass=?");
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$stmt->bind_result($groupid, $id, $name, $avatar);
	$stmt->fetch();

	$ret = false;
	$gid = $groupid;
	if(!$groupid){
		header('Location: login.html');
		echo "not found";
		$ret = false;
	}else{
		session_start();
    	$_SESSION['user'] = $name;
    	$_SESSION['group'] = $gid;
    	$_SESSION['id'] = $id;
    	$_SESSION['avatar'] = $avatar;

    	$_SESSION['time'] = time();
		header('Location: index.php');
		$ret = true;
	}
	$stmt->close();
        $conn->close();
	exit();
	return ret;
?>
