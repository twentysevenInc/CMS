<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style type="text/css">
	#settings-widget-list .item img{
		height: 2rem;
		margin: 0 0.5rem;
		margin-right: 0.4rem;
		float: left;
		background: #000;
		border-radius: 100%;
		padding: 0.25rem;
		margin-top: -0.25rem;
	}

	#settings-widget-list .item input{
		background: none;
		border: rgba(1, 1, 1, 0);
	}

	#settings-widget-plugin h1{
		margin-top: 2rem;
		padding: 0.75em;
	}

	#settings-widget-plugin:nth-child(1) h1{
		margin-top: 0;
	}

	#settings-widget-list .item .button{
		float: right;
		margin-top: -0.4em;
	}
</style>

<script type="text/javascript">
	function addWidgetToDashboard(elem){
		var el = $(elem).parent();
		doAjax('settings/lib/insertWidget.php', 'POST', 'id='+el.attr('data'), function(data){
			$(elem).removeClass('normal-button');
			$(elem).addClass('green-button');
			$(elem).html('Done');

			setTimeout(function(){
				$(elem).removeClass('green-button');
				$(elem).addClass('normal-button');
				$(elem).html('Add');				
			}, 500);
		});
	}
</script>

<div class="page-header">
	<h1>Add Widget</h1>
	<h4>Select a widget to add it to your dashboard</h4>
</div>

<?php

$db = new Database;
$result = $db->query('SELECT plugin.name FROM `cms-plugin` AS plugin
		INNER JOIN `cms-widget` AS widget ON (plugin.id = widget.pluginid)
		INNER JOIN `cms-groupEnablesPlugin` AS gep ON(gep.pluginId = plugin.id)
		INNER JOIN `cms-group` AS gr ON (gep.groupId = gr.id)
		WHERE gr.id = '.$_SESSION['group'].' GROUP BY plugin.id');
?>

<div id="settings-widget-list">
<?php
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	?>
	<div id="settings-widget-plugin">
		<script type="text/javascript">
		console.log("<?php echo $row['name']; ?>");
		</script>
		<h1><?php echo $row['name']; ?></h1>
		<div class="list">

		<?php
			$res = $db->query('SELECT widget.name, widget.id FROM `cms-widget` AS widget 
				INNER JOIN `cms-plugin` AS plugin ON widget.pluginid = plugin.id
				WHERE plugin.name = \''.$row['name'].'\'');
			while ($r = mysql_fetch_array($res, MYSQL_ASSOC)) {
				// echo $r['name'];
				?>
				<div class="item" data="<?php echo $r['id']; ?>">
					<input type="text" value="<?php echo $r['name']; ?>">
					<a href="javascript:void(0);" class="button normal-button" onclick="javascript:addWidgetToDashboard(this);">Add</a>
				</div>
				<?php
			}
		?>
		</div>
	</div>
	<?php
}
?>