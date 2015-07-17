<?php

/* REMOVE*/
include('/var/www/cms/include/error.php');
/* REMOVE*/
include('/var/www/cms/include/settings.php');

function checkLogin(){
	session_start();

	// back to normal
	// $delta = time() - $_SESSION['time'];
	// if($delta > 144){
	// 	header("Location: logout.php");
	// }
	$_SESSION['time'] = time();

	if(empty($_SESSION['user'])){
		return false;
	}else{
		return true;
	}
}

function l($message){
	date_default_timezone_set('Europe/Rome');
	$date = date('d/m/Y H:i:s', time());
	file_put_contents("/var/www/cms/cms.log", "log[".$date."]: ".$message."\n", FILE_APPEND);
}

function e($message){
	date_default_timezone_set('Europe/Rome');
	$date = date('d/m/Y H:i:s', time());
	file_put_contents("/var/www/cms/cms.log", "err[".$date."]: ".$message."\n", FILE_APPEND);
}

?>