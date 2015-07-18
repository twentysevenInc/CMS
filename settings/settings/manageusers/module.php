<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<script type="text/javascript">
	delete_name = "";
	delete_group = "";
	delete_elem = "";

	function deleteThisUser(elem){
		delete_elem = $(elem).parent().parent();
		delete_name = $(delete_elem).find('.table-name').text();
		delete_group = $(delete_elem).find('.table-group').text();

		showWarning(
			'Are you sure?', 
			'This user will be deleted permanently!', 
				[
					'Go ahead',
					'Cancel'
				], 
				[
					'red-button',
					'normal-button'
				], 
				[
					function(){
						ajaxUserDeleteRequest();
					}, 
					function(){
						hideAlerts();
					}
				]
		);
	}

	function ajaxUserDeleteRequest(){
		var ret = doAjax(
			'settings/settings/manageusers/deleteUser.php', 
			'POST', 
			'user='+delete_name+'&group='+delete_group, 
			function(data){
				$(delete_elem).slideUp(300);
				$(delete_elem).remove();
				hideAlerts();
		});
	}
</script>

<div id="manage-users">
<div class="settings-table-title">
	<h1>Users</h1>
	<h4>Manage the users of the cms.</h4>
	<a href="javascript:void(0);" onclick="javascript:navigateTo('settings/settings/manageusers/addUser.php', '#settings', undefined)" class="button normal-button">New User</a>
</div>

<div>
<table>

	<tr>
		<td></td>
		<td>Username</td>
		<td>Email</td>
		<td>Group</td>
		<td></td>
	</tr>
<?php
$db = new Database;
$result = $db->query("SELECT user.name AS name, user.avatar, g.name AS grname, user.email FROM `cms-user` as user INNER JOIN `cms-group` AS g ON (g.id = user.groupId) ORDER BY user.name");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo("<tr>");
		echo "<td><img src='".$row['avatar']."'></td>";
		echo "<td class='table-name'>".$row['name']."</td>";
		echo "<td>".$row['email']."</td>";
		echo "<td class='table-group'>".$row['grname']."</td>";
		echo "<td>
			<a href='javascript:void(0);' class='awesome'></a>
			<a href='javascript:void(0);' class='awesome awesome-red' onclick=\"deleteThisUser(this);\"></a>
		</td>";
	echo("</tr>");
}
?>
</table>
</div>

<!-- <div class="manage-users-buttons">
	<a href="javascript:void(0);" onclick="javascript:navigateTo('settings/settings/manageusers/addUser.php', '#settings', undefined)" class="button green-button">Add new User</a>
</div> -->

</div>