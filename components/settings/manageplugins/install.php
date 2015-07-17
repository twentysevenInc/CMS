<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style type="text/css">	
#add-group form{
	margin: 0.5rem 1rem;
}
</style>


<div id="add-group">
	<div class="page-header">
		<h1>Install a Plugin</h1>
		<h4>Please upload a zip of your Plugin to install it.</h4>
	</div>

	<form>
		<input type="file" placeholder="Plugin.zip"/>
		<input type="submit" value="Upload" class="button green-button"/>
	</form>
</div>