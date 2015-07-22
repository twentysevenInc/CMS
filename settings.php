<?php
include('include/general.php');
include('include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		menuLoadSite('#settings-content', 'settings/cms.php', $('#settings .menu a')[0]);
	});
</script>

<style type="text/css">
	#settings-content{
		position: relative;
	}

	#settings-content div{
		display: inline-block;
	}
</style>

<div id = "settings">
	<ul class = "menu">
		<h1><a href="javascript:void(0);" onClick="menuLoadSite('#settings-content', 'settings/cms.php', this)" class="active" data="CMS">CMS</a></h1>
		<?php if ($_SESSION['notification']){?>
		<h1><a href="javascript:void(0);" onClick="menuLoadSite('#settings-content', 'settings/notifications.php', this)" data="Notifications">Notifications</a></h1>
		<?php } if ($_SESSION['plugin']){?>
		<h1><a href="javascript:void(0);" onClick="menuLoadSite('#settings-content', 'settings/plugin.php', this)" data="Plugins">Plugins</a></h1>
		<?php } if ($_SESSION['admin']){?>
		<h1><a href="javascript:void(0);" onClick="menuLoadSite('#settings-content', 'settings/admin.php', this)" data="Admin">Admin</a></h1>
		<?php } ?>
	</ul>

	<section id = "settings-content">
	</section>
</div>
