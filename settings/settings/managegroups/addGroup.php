<?php
include('../../../include/general.php');
include('../../../include/database.php');
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
		<h1>Add a Group</h1>
		<h4>You can add another Group to the CMS.</h4>
	</div>

	<form>
		<input type="text" placeholder="Groupname"/>
		<input type="submit" value="Create" class="button green-button"/>
	</form>
</div>
