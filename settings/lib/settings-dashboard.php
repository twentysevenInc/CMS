<?php
include('../../include/general.php');
include('../../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<?php

  $dat = new Database;
  $result = $dat->query("SELECT widget.name AS widgetName, userDashboard.width, userDashboard.height, plugin.name AS pluginName, widget.reload AS reload FROM `cms-userDashboard` AS userDashboard
  	INNER JOIN `cms-widget` AS widget ON userDashboard.widgetId = widget.id
  	INNER JOIN `cms-user` AS user ON userDashboard.userId = user.id
  	INNER JOIN `cms-plugin` AS plugin ON plugin.id = widget.pluginId WHERE user.id = " . $_SESSION['id'] . " ORDER BY userDashboard.position");

  $dashboard = array();

  while($row = mysql_fetch_object($result)){
    array_push($dashboard, $row);
  }
?>

<div id = "dashboard">
	<!-- <h1>Dashboard</h1>
	<p>Here you go, Sir!</p> -->
	<?php

		if(empty($dashboard)){
			?>
				<h1>No widget added, yet</h1>
			<?php
		}

		foreach($dashboard as $row){
			echo "<div class=\"widget ";
			if($row->width == 1){
				echo "quarterwidth";
			}
			else if($row->width == 2){
				echo "halfwidth";
			}
			else if($row->width == 3){
				echo "threewidth";
			}
			else{
				echo "fullwidth";
			}

			if($row->height == 1){
				echo " oneheight-small";
			}
			else if($row->height == 2){
				echo " twoheight-small";
			}
			else if($row->height == 3){
				echo " threeheight-small";
			}
			else{
				echo " fourheight-small";
			}
			echo "\" pluginname='".$row->pluginName."' widgetname='".$row->widgetName."' reload='0'>";
			echo '<h1>'.$row->widgetName.' <span>('.$row->pluginName.')</span></h1>';
			// include 'plugins/' . $row->pluginName . '.plugin/widgets/' . $row->widgetName . '/widget.php';
			echo "</div>";
		}
	?>

</div>
