<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<div id = "notifications">
	<ul class = "menu">
		<h1><a href="javascript:void(0);" onClick="changeView(this)" class="active" data="Notifications">Notifications</a></h1>
		<h1><a href="javascript:void(0);" onClick="changeView(this)" data="Actions">Actions</a></h1>
	</ul>

	<section id = "notifications-content">
	</section>
</div>
