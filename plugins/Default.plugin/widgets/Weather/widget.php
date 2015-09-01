<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<style type="text/css">
#weather-widget{
	background: #F89406;
	/*background: #fff;*/
	font-family: 'Montserrat';
	padding: 1rem;
	position: absolute;
	top: 0;bottom: 0;
	left: 0;right: 0;

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
	-webkit-box-orient: horizontal;
	-webkit-box-direction: normal;
	-webkit-flex-direction: row;
	-ms-flex-direction: row;
	flex-direction: row;
}
#weather-widget h1{
	color: white;
	opacity: 0.75;
	text-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
	text-align: center;
	font-size: 2em;
	margin-top: 0em;
}

#weather-widget h2{
	color: #fff;
	opacity: 0.5;
	text-shadow: 0px 0px 3px rgba(0, 0, 0, 0.5);
	text-align: center;
	font-size: 1em;
}

.weather-icons{
	height: 100%;
}

.weather-icons img{
	opacity: 0;
	height: 70%;
	width: auto;
}
</style>

<script type="text/javascript">

	var color = ['#2C3E50', '#663399', '#DB0A5B', '#F64747', '#F5AB35', '#F1C40F', '#F5AB35',
				'#F39C12', '#E67E22', '#F64747', '#8E44AD', '#34495E'];

	$(document).ready(function(){
		$.ajax({
			'async': true,
			'url': 'http://api.openweathermap.org/data/2.5/weather?q=Graz,at&units=metric',
			'dataType': "json",
			'success': function (data) {
				// console.log(data);
				// console.log(data);
				// console.log(data);
				var d = new Date();
				var n = Math.floor(d.getHours() / 2);

				if(4 < n && n < 9){
					$('#weather-widget h2').css({
						'color':'#000',
						'opacity':'0.25',
						'text-shadow':'none'
					});
				}

				$("#weather-widget").css("background", color[n]);

				$("#weather-widget h1").html(Math.floor(parseFloat(data['main']['temp']))+"°");
				$("#weather-widget h2").html(data['name']+", "+data['sys']['country']);

				$('#weather-widget img').attr("src", "plugins/Default.plugin/widgets/Weather/img/sun.png");

				if ('clouds' in data){
					var clouds = parseFloat(data['clouds']['all']);
					if (clouds > 30) {
						$('#weather-widget img').attr("src", "plugins/Default.plugin/widgets/Weather/img/cloud.png");
					};
				}
				if('rain' in data){
					var rain = data['rain']['1h'];
					rain = parseFloat(rain);
					if (rain > 0.1) {
						$('#weather-widget img').attr("src", "plugins/Default.plugin/widgets/Weather/img/rain.png");
					};
				}
				if('snow' in data){
					var snow = data['snow']['3h'];
					snow = parseFloat(snow)
					if(snow > rain){
						$('#weather-widget img').attr("src", "plugins/Default.plugin/widgets/Weather/img/snow.png");
					};
				}

				$('#weather-widget img').animate({
					"opacity":0.85
				}, 500);
			}
		});
	});
</script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<div id ="weather-widget">
	<div class="weather-icons">
		<img src="plugins/Default.plugin/widgets/Weather/img/sun.png">
		<h1></h1>
		<h2></h2>
	</div>
</div>
