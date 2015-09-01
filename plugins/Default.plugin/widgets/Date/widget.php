<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<style type="text/css">
#date-widget{
	background: #fff;
	/*background: #fff;*/
	position: absolute;
	top: 0;bottom: 0;
	left: 0;right: 0;
}

#date-widget h1{
	color: #000;
	font-size: 5rem;
	font-weight: 900;
	text-align: center;
}

#date-widget h1 span{
	color: #ccc;
}

#date-witget h2{
	color: #000 !important;
}

</style>

<script type="text/javascript">
$(document).ready(function(){
	var objToday = new Date();
})
</script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<div id ="date-widget" class="flex">
	<h1>24<span>th</span></h1>
	<h2>June</h2>
</div>
