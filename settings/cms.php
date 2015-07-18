<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style type="text/css">
	#settings-cms{
		position: relative;
		padding: 2rem 1.5rem;
		width: 100%;
		/*background: #eee;*/
	}

	#settings-cms h1{
		font-size: 2em;
	}

	#settings-cms h4{
		font-weight: 400;
		color: #888;
	}

	#add-widget{
		position: absolute;
		top: 3rem;
		right: 1rem;
	}

	#settings-cms ul{
		width: 35%;
		float: left;
		margin: 1rem 0;
		margin-top: 3rem;
		padding-right: 1.5rem;
	}

	#settings-cms ul li{
		display: block;
		font-size: 14pt;
		padding: 0.5em 1em;
		background: #eee;
		border: 1pt solid #fff;
	}

	#settings-cms ul li span{
		float: right;
		color: #888;
		font-size: 12pt;
		margin-top: 1pt;
	}

	#settings-cms ul li a{
		float: right;
		margin: 2pt 0;
		margin-left: 1rem;
	}

	#settings-cms #preview-dashboard{
		margin: 1rem 0;
		margin-top: 3rem;
		width: 65%;
		background: #03C9A9;
		float: left;
	}

	#settings-cms #preview-dashboard #dashboard{
		width: 100%;
	}

	#settings-cms #preview-dashboard #dashboard *{
		background: #fff;
	}

	#settings-cms #preview-dashboard #dashboard .widget{
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;

		/*-webkit-box-orient: horizontal;
		-webkit-box-direction: normal;*/
		/*-webkit-flex-direction: row;
		-ms-flex-direction: row;
		flex-direction: row;*/
	}

	#settings-cms #preview-dashboard #dashboard h1{
		margin: auto;
		text-align: center;
		font-size: 1.1rem;
		color: #bbb;

		padding: 1em 0;
	}

	#settings-cms #preview-dashboard #dashboard h1 span{
		font-size: 1.1rem;
		color: #aaa;
		font-weight: 400;
	}
</style>

<script type="text/javascript">
	function reloadDashboardPreview(){
		doAjax('settings/lib/settings-dashboard.php', 'GET', '', function(data){
			$('#preview-dashboard').html(data);
		});
	}

	$(document).ready(function () {
		reloadDashboardPreview();

	  $(function() {
	    $( "#settings-cms ul").sortable({
			update: function( event, ui ) {
				var dash = '{"data":[';
				$.each($("#settings-cms ul li"), function(i, val){
					dash += '{"id":'+$(val).attr('data')+', "index":'+(i+1)+'},';
				});
				dash = dash.substr(0, dash.length - 1) + "]}";
				doAjax('settings/lib/updateDashboard.php', 'POST', 'data='+dash, function(data){
					reloadDashboardPreview();
				});
			}
		});
	    $( "#settings-cms ul").disableSelection();
	  });
	});

	function deleteThisWidget(elem){
		elem = $(elem).parent();
		// console.log($(elem));
		doAjax('settings/lib/deleteWidget.php', 'POST', 'data='+$(elem).attr('data')+'&pos='+$(elem).attr('pos'), function(d){
			$(elem).animate({
				'heigth':0,
				'opacity':0,
				'marginTop':0,
				'marginBottom':0,
				'paddingTop':0,
				'paddingBottom':0
			}, 200);
			setTimeout(function(){
				$(elem).remove();
			}, 200);
			reloadDashboardPreview();
		});
	}
</script>

<div id="settings-cms">
	<div class="page-header">
		<h1>Dashboard</h1>
		<h4>Customize your Dashboard.</h4>
		<a href="javascript:void(0);" onclick="javascript:navigateTo('settings/lib/addWidget.php', undefined)" class="normal-button button" id="add-widget">Add Widget</a>
	</div>

	<ul>
<!-- <tr>
	<td>Name</td>
</tr> -->
<?php
$db = new Database;
$servername = $db->dbHost;
$username = $db->dbUser;
$password = $db->dbPass;
$dbname = $db->db;

$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_SESSION['id'])){
	$db = new Database;
	$servername = $db->dbHost;
	$username = $db->dbUser;
	$password = $db->dbPass;
	$dbname = $db->db;

	$conn = new mysqli($servername, $username, $password, $dbname);
	$query = $conn->stmt_init();

	$query->prepare("
		SELECT widget.name, widget.id, plugin.name FROM `cms-userDashboard` AS userDashboard
		INNER JOIN `cms-widget` AS widget ON (widget.id = userDashboard.widgetId)
		INNER JOIN `cms-plugin` AS plugin ON widget.pluginId = plugin.id
		WHERE userDashboard.userId = ?
		ORDER BY userDashboard.position
		");
	$query->bind_param("i", $_SESSION['id']);
	$query->execute();

	$query->bind_result($name, $id, $plugin);

	$n = 1;
	while($query->fetch()){
		echo "<li draggable='true' data='".$id."' pos='".((int)$n)."'>".$name."<a href='javascript:void(0);' onclick='javascript:deleteThisWidget(this);' class='awesome'></a><span>".$plugin."</span>"."</li>";
		$n++;
	}
}
?>
</ul>
<div id="preview-dashboard">
	<!--?php
		include('../dashboard.php');
	?-->
</div>
</div>

<!-- <div id="settings-cms">
	<h1>Sidebar</h1>
	<h4>Customize your Sidebar.</h4>
</div> -->
