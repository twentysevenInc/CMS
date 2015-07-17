<!DOCTYPE html>
<html>
<?php
include('include/general.php');
include('include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<head>
	<title>CMS</title>

	<!-- Js libs -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="script/main.js"></script>
	<script src="script/responsive.js"></script>

	<!-- CSS -->
	<!-- <link rel="stylesheet" href="style/main.css" type="text/css"> -->
	<link rel="stylesheet" href="style/main.css" type="text/css">

	<!-- Responsive -->
	<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, user-scalable=no">

	<!-- Charset -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8">


	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

	<!-- CSS/JS -->
	<?php
		$db = new Database;
		$result = $db->query("SELECT * FROM `cms-plugin` AS plugin INNER JOIN `cms-groupEnablesPlugin` AS gei ON (plugin.id = gei.pluginId) LIMIT 0 , ".$maxSidebarItems);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if($_SESSION['group'] <= $row['groupId']){
				echo ("<link rel=\"stylesheet\" href=\"plugins/".$row['name'].".plugin/main.css\" type=\"text/css\">");
				echo ("<script type=\"text/javascript\" src=\"plugins/".$row['name'].".plugin/main.js\"></script>");
			}
		}
	?>
</head>
<body>

<div id="darken"></div>

<div id="alert" class="verticalCenter">
	<h2></h2><p></p><li></li>
</div>

<div id="warning" class="verticalCenter">
	<h2></h2><p></p><li></li>
</div>

<nav>
	<li>
		<a href="javascript:void(0);" onClick="sidebar(event);" class="awesome"></a>
	</li>
	<li>
		<a href="javascript:void(0);" onClick="notifications(event);" class="awesome"></a>
		<ul id="notifications">
			<div id="notificationArrow"></div>
			<li>
				Notification
			</li>
			<li>
				Notification
			</li>
			<li>
				Notification
			</li>
		</ul>
	</li>
	<li>
		<a href="javascript:void(0);" onclick="javascript:cmsLoadSite('settings.php')" class="awesome"></a>
	</li>
	<li>
		<a href="javascript:void(0);" onclick="javascript:cmsLoadSite('state.php')" class="awesome"></a>
	</li>
	<li>
		<a href="logout.php" class="awesome"></a>
	</li>
</nav>

<section id="sidebar">
	<!-- div class="sidebar-user">
			<a href="javascript:cmsLoadSite('user.php')">
				<img src=<?php echo "\"".$_SESSION['avatar']."\""; ?>/>
				<h3><?php echo $_SESSION['user']; ?> </h3>
			</a>
			<a href="javascript:void(0);" onClick="sidebar(event);" id="hideSidebar" class="awesome"></a>
	</div-->

	<div class="sidebar-content">
		<div class="sidbar-section">
			<h1>User</h1>
			<a href="javascript:void(0);" onclick="javascript:cmsLoadSite('dashboard.php')" class="sidebar-selected"><img src="img/sidebar/dash.png"><span>Dashboard</span></a>
			<a href="javascript:void(0);" onClick="javascript:cmsLoadSite('user.php')"><img src="img/sidebar/user.png"><span>Profile</span></a>
		</div>
		<div class="sidbar-section">
			<h1>Plugins</h1>
		<?php
			$result = $db->query("SELECT plugin.visible, plugin.name FROM `cms-plugin` AS plugin INNER JOIN `cms-groupEnablesPlugin` AS gei ON (plugin.id = gei.pluginId) WHERE gei.groupId = (SELECT `cms-user`.groupId FROM `cms-user` WHERE `cms-user`.name = '".$_SESSION['user']."') LIMIT 0 , ".$maxSidebarItems);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				if($row['visible']){
					$file = (file_exists("plugins/".$row['name'].".plugin/icon.png")) ? "plugins/".$row['name'].".plugin/icon.png" : "img/sidebar/default.png";
					echo("
							<a href=\"javascript:void(0);\" onclick=\"javascript:cmsLoadSite('plugins/".$row['name'].".plugin/index.php')\"><img src=\"".$file."\"><span>".$row['name']."</span></a>
						");
				}
			}
		?>
		</div>
		<div class="sidbar-section">
			<h1>Admin</h1>
			<a href="javascript:void(0);" onclick="javascript:cmsLoadSite('settings.php')"><img src="img/sidebar/settings.png"/><span>Settings</span></a>
			<a href="javascript:void(0);" onclick="javascript:cmsLoadSite('state.php')"><img src="img/sidebar/state.png"/><span>State</span></a>
			<a href="logout.php"><img src="img/sidebar/logout.png"/><span>Logout</span></a>
		</div>
	</div>
</section>
<section id="overlay">
	<img src="img/loader.svg"/>
</section>

<section id="content"></section>

</body>
</html>
