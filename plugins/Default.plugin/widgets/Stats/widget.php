<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<style type="text/css">
#statswidget {
	width: 100%;
	height: 100%;
	display: block;
	padding: 1rem;
	position: relative;
}
#statswidget .verticalCenter {
	left: 2rem;
}
#statswidget .progress {
	width: 16rem;
	display: block;
	margin-left: 0;
	margin-bottom: 1rem;
}
#statswidget .progress:last-of-type {
	margin-bottom: 0;
}
#statswidget .progress h2{
	font-size: 1rem;
	color: #888;
	font-weight: 500;
	margin-bottom: 0.2rem;
}
#statswidget .progress div{
	width: 100%;
	overflow: hidden;
	border-radius: 6px;
	background-color: #d6d6d6;
	display: block;
}
#statswidget .progress div span{
	text-align: right;
	padding-right: 0.2rem;
	display: block;
	float: left;
	border-radius: 6px;
	background-color: #4183D7;
	color: white;
	
background: #207ce5; /* Old browsers */
background: -moz-linear-gradient(left, #207ce5 0%, #499bea 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,#207ce5), color-stop(100%,#499bea)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left, #207ce5 0%,#499bea 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left, #207ce5 0%,#499bea 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left, #207ce5 0%,#499bea 100%); /* IE10+ */
background: linear-gradient(to right, #207ce5 0%,#499bea 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#207ce5', endColorstr='#499bea',GradientType=1 ); /* IE6-9 */
}
</style>

<div id = "statswidget">
	<div class = "verticalCenter">
		<div class = "progress">
			<h2>CPU Usage</h2>
			<div><span style="width:81%;">81%</span></div>
		</div>
		<div class = "progress">
			<h2>Free RAM</h2>
			<div><span style="width:27%;">27%</span></div>
		</div>
		<div class = "progress">
			<h2>Awesomeness</h2>
			<div><span style="width:94%;">94%</span></div>
		</div>
	</div>
</div>