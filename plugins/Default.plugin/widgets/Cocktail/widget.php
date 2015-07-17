<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<style type="text/css">
	#widget_cocktail {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		display: block;
	}
	.ingredient {
		width: 100%;
		display: block;

		text-align: center;
		font-size: 2rem;
		text-transform: uppercase;
		color: rgba(255,255,255,0.8);
	}
	.lime {
		background-color: #2ECC71;
	}
	.orange {
		background-color: #F89406;
	}
	.vodka {
		background-color: #ddd;
	}
</style>

<div id = "widget_cocktail">
	<div class = "ingredient lime" style="height:10%;">lime</div>
	<div class = "ingredient orange" style="height:60%;">orange</div>
	<div class = "ingredient vodka" style="height:30%;">vodka</div>
</div>