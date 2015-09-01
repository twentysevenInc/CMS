<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<div class="page-header">
	<div class="page-header-title">
		<h1>Plugin Settings</h1>
		<h4>Once we're done here will be your Plugin settings.</h4>
	</div>
	<div class="page-header-actions">
	</div>
</div>

<div class="list">
<?php
	$db = new Database;
	$result = $db->query("SELECT plugin.visible, plugin.name FROM `cms-plugin` AS plugin INNER JOIN `cms-groupEnablesPlugin` AS gei ON (plugin.id = gei.pluginId) WHERE gei.groupId = (SELECT user.groupId FROM `cms-user` as user WHERE user.name = '".$_SESSION['user']."') LIMIT 0 , ".$maxSidebarItems);
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
