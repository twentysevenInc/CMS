<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<style type="text/css">
#date-widget{
	background: #000;
	/*background: #fff;*/
	position: absolute;
	top: 0;bottom: 0;
	left: 0;right: 0;
}

#date-widget > h1{
	text-align: center;
	font-size: 7em;
	height: 1em;
	font-family: 'Helvetica Neue';
	font-weight: 900;
	color: white;
	height: 70%;
	width: 60%;
	margin: 0 auto;
	padding-top: 20%;
}

#date-widget h1 > span{
	font-size: 0.3em !important;
	margin-top: -3em;
	font-weight: 400;
	font-family: 'Helvetica Neue';
	color: white;
}

#date-widget h2{
	font-size: 2em;
	opacity: 0.7;
	font-family: 'Helvetica Neue';
	color: white;
	text-align: center;
	margin: 0 auto;
}

</style>

<script type="text/javascript">
$(document).ready(function(){
	var objToday = new Date();
})
</script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<div id ="date-widget">
	<h1>24<span>th</span></h1>
	<h2>June</h2>
</div>
