<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<div id="manage-groups">
<div class="settings-table-title">
	<h1>Groups</h1>
	<h4>Add, edit and delete groups.</h4>
	<a href="javascript:void(0);" onclick="javascript:navigateTo('components/settings/managegroups/addGroup.php', '#settings', undefined)" class="button normal-button">New Group</a>
</div>

<div>
<table>

	<tr>
		<td>ID</td>
		<td>Name</td>
		<td></td>
	</tr>
<?php
$db = new Database;
$result = $db->query("SELECT g.name, g.id FROM `group` AS g ORDER BY g.name");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo("<tr>");
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['name']."</td>";
		echo "<td><a href='#' class='awesome'></a></td>";
	echo("</tr>");
}
?>
</table>
</div>
<!-- <div class="manage-groups-buttons">
	<a href="javascript:void(0);" onclick="javascript:navigateTo('components/settings/managegroups/addGroup.php', '#settings', undefined)" class="button green-button">Add new Group</a>
</div> -->

</div>