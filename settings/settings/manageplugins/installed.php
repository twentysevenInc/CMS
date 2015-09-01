<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style>
#plugin-successfully-installed{
	text-align: center;
	width: 100%;
	padding-top: 25vh;
}

#plugin-successfully-installed h1{
	font-size: 3rem;
	padding: 2rem 0;
	display: block;
	width: 100%;
}
</style>

<script type="text/javascript">

function finishInstall(){
	setCookie("cms-site", "dashboard.php", 100);
	document.location = document.location;
}

</script>

<div id="plugin-successfully-installed">
	<h1>Plugin successfully installed!</h1>
	<a class="button green-button" href="javascript:void(0)" onclick="finishInstall()" >Finish</a>
</div>
