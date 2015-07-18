<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
    header("Location: login.html");
}
?>

<?php

$target_dir = "../tmp/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);

if (!isset($_FILES['file'])){
    echo "{\"type\":0, \"message\":\"No file was uploaded.\"}";
    return;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "{\"type\":0, \"message\":\"File already exists.\"}";
    return;
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "{\"type\":0, \"message\":\"Plugin is too large.\"}";
    return;
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "zip") {
    echo "{\"type\":0, \"message\":\"The Plugin must be zipped.\"}";
    return;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    return;
    echo "{\"type\":0, \"message\":\"Plugin wasn’t uploaded.\"}";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

        $file = $target_file;

        $zip = new ZipArchive;
        $res = $zip->open($file);
        if ($res === TRUE) {

            $name = str_replace(".zip", "", $target_file);

            $zip->extractTo('../tmp/');
            $zip->close();
            unlink($target_file);

            $name = "";
            if ($handle = opendir('../tmp/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $name = "$entry";
                    }
                }
                closedir($handle);
            }
            $path = '../tmp/'.$name.'/config.json';
            $content = file_get_contents($path);
            echo "{\"type\": 1, \"message\":\"Plugin successfully uploaded.\", \"data\":$content}";
        } else {
            echo "{\"type\":0, \"message\":\"There was an error uploading your Plugin.\"}";
        }
    } else {
    	echo "{\"type\":0, \"message\":\"There was an error uploading your Plugin.\"}";
    }
}

?>