<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

function randomPassword($len) {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789-------";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $len; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$pw = randomPassword(16);
$db = new Database;
$db->query("INSERT INTO user (groupId, name, avatar, pass, email) VALUES((SELECT id FROM `group` WHERE name='".$_POST['group']."'), '".$_POST['user']."', 'img/default.jpg', '".hash('sha512', $pw)."', '".$_POST['email']."')");

echo '{"password":"'.$pw.'"}';

?>