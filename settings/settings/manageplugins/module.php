<?php
include('../../../include/general.php');
include('../../../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<script type="text/javascript">
pluginName = ""
	function deletePlugin(elem){
		var name = $($($(elem).parent()).parent().find('td')[0]).text();
		pluginName = name;
		var author = $($($(elem).parent()).parent().find('td')[2]).text();
		showWarning('Are you sure?',
		'\''+name+'\' by '+author+' will be unistalled from your cms',
		[
			'Yes',
			'Cancel'
		], [
			'red-button',
			'normal-button'
		],[
			function(){
				doAjax('settings/settings/manageplugins/lib/make-unistall.php', 'POST', {'name':pluginName}, function(data){
					hideAlerts();
					setCookie('cms-site', 'dashboard.php', 100);
					document.location = document.location;
				});
			},
			function(){
				hideAlerts();
			}
		]);
	}
</script>

<div id="manage-plugins">
<div class="settings-table-title">
	<h1>Plugins</h1>
	<h4>Install and remove plugis.</h4>
	<a href="javascript:void(0);" onclick="javascript:navigateTo('settings/settings/manageplugins/install.php', '#settings', undefined)" class="button normal-button">Install Plugin</a>
</div>

<div>
<table>

	<tr>
		<td>Name</td>
		<td>Version</td>
		<td>Author</td>
		<td></td>
	</tr>
<?php
$db = new Database;
$result = $db->query("SELECT plugin.name, plugin.author, plugin.version FROM `cms-plugin` as plugin ORDER BY plugin.name");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo("<tr>");
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['version']."</td>";
		echo "<td>".$row['author']."</td>";
		echo "<td><a href='javascript:void(0);' onclick='javascript:deletePlugin(this);' class='awesome awesome-red'></a></td>";
	echo("</tr>");
}
?>
</table>
</div>

<!-- <div class="manage-plugins-buttons">
	<a href="javascript:void(0);" onclick="javascript:navigateTo('components/settings/manageplugins/install.php', '#settings', undefined)" class="button green-button">Install</a>
</div> -->

</div>
