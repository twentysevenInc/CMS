<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<style type="text/css">
	#welcome-widget {
		display: block;
		background-color: #36D7B7;

		text-align: center;
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
	}

	#welcome-widget h1 {
		color: white;
		opacity: 0.8;
		margin-top: 4rem;
	}
	#welcome-widget h2 {
		margin-top: 1rem;
		color: white;
	}

	#welcome-widget p {
		color: #fff;
		opacity: 0.8;
		margin-top: 5rem;
		font-size: 1.2rem;
	}
	#welcome-widget a {
		color: #36D7B7;
		background-color: #fff;
		padding: 0.4rem 0.6rem;
		border-radius: 100px;
		margin-left: 0.2rem;
	}
	#welcome-widget a:hover {
		opacity: 0.8;
	}
</style>

<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->

<div id ="welcome-widget">
	<h1>Cheers</h1>
	<h2>Here's your mind-blowing new dashboard</h2>
	<p>Check out some cool widgets <a href="javascript:void(0);" onclick="javascript:navigateTo('settings/lib/addWidget.php', undefined)">here</a></p>
</div>
