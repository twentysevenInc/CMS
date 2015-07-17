<?php
include('../include/general.php');
include('../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

l('Starting CMS State check');

//Internet Connection
$internet_connection = false;
$response = null;
system("ping -c 1 google.com", $response);
if($response == 0)
{
    $internet_connection = true;
}else{
    e('No internet connection');
}

//Health
$health = (rand(0, 3)==1)?'false':'true';
if(strcmp($health,'false') == 0){
    e('Health\'s not o.k.');
}



if($internet_connection &&
   $health){
    l('Finished CMS State check. Everything seems great');
}else{
    e('Finished CMS State check. it seems like something\'s not working');
}

$status = array(
    'Database' => 'true',
    'Filesystem' => 'true',
    'Plugins' => 'true',
    'Services' => 'true',
    'Internet connection' => ($internet_connection)?'true':'false',
    'Auto Updater' => 'false',
    'Notifications' => 'false',
    'Security' => 'true',
    'Chat' => 'false',
    'Proxy' => 'true',
    'Permissions' => 'true',
    'Health' => $health
);

$fp = fopen('/var/www/cms/checkSystem/systemstatus.json', 'w');
fwrite($fp, json_encode($status));
fclose($fp);

echo 'okay';
?>