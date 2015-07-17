<?php
include('include/general.php');
include('include/database.php');
checkLogin();
session_destroy();
header("Location: login.html");
?>