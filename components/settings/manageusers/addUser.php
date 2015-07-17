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

#create-user-profile{
	background: #eee;
	width: 100%;
}

#create-user-profile > div{
	width: 50%;
	float: left;
}

#create-user-profile > div:nth-of-type(1) img{
	width: 4rem;
}

</style>

<script type="text/javascript">
	function createCmsUser(form){
		var user = $($(form).find('input')[0]).val();
		var email = $($(form).find('input')[1]).val();
		var opt = $(form).find('option:selected').text();

		var ret = doAjax(
			'components/settings/manageusers/insertUser.php', 
			'POST', 
			'user='+user+'&group='+opt+'&email='+email, 
			function(data){
				var obj = jQuery.parseJSON(data);
				$('#new-password').append('Password: '+obj['password']);
				$('#add-group input')[0].value = '';
				$('#add-group input')[1].value = '';
		});

		return false;
	}
</script>


<div id="add-group">
	<div class="page-header">
		<h1>Add a new User</h1>
		<h4>You can add a new User to the CMS.</h4>
	</div>

	<div id="create-user-profile">
		<div>
			<img src="img/default.jpg">
		</div>
		<div>
			<form onsubmit="return createCmsUser(this);">
				<input type="text" placeholder="Username" name="username"/>
				<input type="text" placeholder="Email" name="email"/>
				<select>
				<?php
					$db = new Database;
					$result = $db->query("SELECT id, name FROM `group`");
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
					}
				?>	  
				</select>
				<input type="submit" value="Create" class="button green-button"/>
				<h5 id="new-password"></h5>
			</form>
		</div>
	</div>
</div>