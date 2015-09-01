<?php
include('../../../include/general.php');
include('../../../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style type="text/css">
	.plugin-check-users{

	}

	.plugin-check-users li{
		/*border: 1px solid #ddd;*/
		background: #fff;
		border: 1px solid #ddd;
		width: 20rem;
		max-width: 90%;
		display: inline-block;
		padding: 0.5rem;
		margin: 0.5rem;
		border-radius: 0.25em;
	}

	.plugin-check-users li label{
		text-align: left;
		vertical-align: top;
		height: 2rem;
		line-height: 2rem;
	}

	.plugin-check-users li .checkbox{
		float: right;
	}

	.plugin-check-users .plugin-check-users-list{
		width: 100%;
	}

	.plugin-check-users .plugin-check-users-actions{
		margin: 0.5rem;
		width: 100%;
	}
</style>

<script type="text/javascript">
function setGroups(){
	var arr = $('.add-group-panel');
	for (var i = 0; i < arr.length; i++) {
		if($(arr[i]).find('input').is(':checked')){
			var group = $(arr[i]).find('label').html();
			var plugin = "<?php echo $_GET['name']; ?>";
			connect(group, plugin);
		}
	}
}

function connect(group, plugin){
	doAjax("settings/settings/manageplugins/lib/connect.php", 'POST', {"group":group, "plugin":plugin}, function(data){
		// doAjax("plugin/"+plugin+".plugin/install.php", "get", "", function(){
		// 	navigateTo("plugin/"+plugin+".plugin/install.php");
		// })
		navigateTo("settings/settings/manageplugins/installed.php");
	});
}
</script>

<div id="add-group">
	<div class="page-header">
		<div class="page-header-title">
			<h1>Cms groups</h1>
			<h4>Choose the groups that can use the Plugin "<?php echo $_GET['name']; ?>".</h4>
		</div>
		<div class="page-header-actions">
		</div>
	</div>

	<div class="plugin-check-users">
		<div class="plugin-check-users-list">
		<?php
			$db = new Database;
			$result = $db->query("SELECT name FROM `cms-group`");
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				?>
				<li class="add-group-panel">
					<label><?php echo $row['name']; ?></label>
					<div class="checkbox onoffswitch maincheckbox">
						<input type='checkbox' name='service' id='checkbox' />
					 <div class="switch"></div>
				</li>
				<?php
			}
		?>
		</div>
		<div class="plugin-check-users-actions">
			<a class="button green-button" href="javascript:void(0);" onclick="javascript:setGroups();">Next</a>
		</div>
	</div>
</div>
