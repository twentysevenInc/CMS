<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<div class="page-header">
	<h1>Plugin Settings</h1>
	<h4>Once we're done here will be your Plugin settings.</h4>
</div>

<div class="list">
<?php
	$db = new Database;
	$result = $db->query("SELECT plugin.visible, plugin.name FROM  plugin INNER JOIN groupEnablesPlugin AS gei ON (plugin.id = gei.pluginId) WHERE gei.groupId = (SELECT user.groupId FROM user WHERE user.name = '".$_SESSION['user']."') LIMIT 0 , ".$maxSidebarItems);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if($row['visible']){
			$file = (file_exists("plugins/".$row['name'].".plugin/icon.png")) ? "plugins/".$row['name'].".plugin/icon.png" : "img/sidebar/default.png";
			?>
				<div class="item">
					<input type="text" class="input-disabled" value="<?php echo $row['name']?>" readonly>
					<div class="checkbox">
						<input type='checkbox' name='service' id='checkbox'/>
						<div class="switch"></div>
					</div>
				</div>
			<?php
		}
	}
?>
</div>
<?php

?>