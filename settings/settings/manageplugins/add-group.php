<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style type="text/css">
	.plugin-check-users{
		margin: 0.5rem 0.7rem;
	}

	.plugin-check-users li{
		border: 1px solid #ddd;
		width: 25%;
		display: inline-block;
		padding: 0.5rem;
		margin: 0.5rem;
		border-radius: 0.25em;
	}

	.plugin-check-users li label{
		background: #fff;
		text-align: left;
		vertical-align: top;
		height: 2rem;
		line-height: 2rem;
	}

	.plugin-check-users li .checkbox{
		float: right;
	}
</style>

<script type="text/javascript">
	
</script>

<div id="add-group">
	<div class="page-header">
		<h1>Add your Plugin to your Groups</h1>
		<h4>Choose the groups that can use your Plugin.</h4>
	</div>

	<div class="plugin-check-users">
		<li>
			<label>Admin</label>
			<div class="checkbox onoffswitch maincheckbox">
				<input type='checkbox' name='service' id='checkbox' />
			<div class="switch"></div>
		</li>

		<li>
			<label>User</label>
			<div class="checkbox onoffswitch maincheckbox">
				<input type='checkbox' name='service' id='checkbox' />
			<div class="switch"></div>
		</li>
	</div>
</div>