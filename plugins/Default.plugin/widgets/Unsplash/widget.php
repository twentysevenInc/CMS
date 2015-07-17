<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

$htmlContent = file_get_contents('http://unsplash.com');

preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags);

$img = "";
for ($i = 0; $i < count($imgTags[0]); $i++) {
	preg_match('/src="([^"]+)/i',$imgTags[0][$i], $imgage);
	$origImageSrc = str_ireplace( 'src="', '',  $imgage[0]);
	if($i == 1){
		$img = $origImageSrc;
	}
}
?>

<style type="text/css">
	#unsplash{
		height: 100% !important;
		width: 100% !important;
		background: #000;
		position: relative;

		transition: 0.3s all ease;
	}
	#unsplash-image{
		position: absolute;
		top: 0;bottom: 0;
		left: 0;right: 0;
		height: 100% !important;
		width: 100% !important;
		background-size: cover;
		background-image: url(<?php echo $img; ?>);
		opacity: 1;
		/*background: #eee;*/
		transition: 0.3s all ease;
	}
	#unsplash-image:hover{
		opacity: 0.5;
	}
	#unsplash-overlay{
		position: absolute;
		top: 0;bottom: 0;
		left: 0;right: 0;
		height: 100% !important;
		width: 100% !important;
		/*background: red;*/
		background: none;
		overflow: auto;
		opacity: 0;

		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-flex-wrap: wrap;
		      -ms-flex-wrap: wrap;
		          flex-wrap: wrap;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		      -ms-flex-direction: column;
		          flex-direction: column;
		-webkit-flex-flow: column nowrap;
		      -ms-flex-flow: column nowrap;
		          flex-flow: column nowrap;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		      -ms-flex-pack: center;
		          justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		      -ms-flex-align: center;
		          align-items: center;
		text-align: center;
		transition: 0.3s all ease;
	}

	#unsplash a{
/*
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
*/
		color: white;
		text-align: center;
/*
		width: 30pt !important;
		height: 50pt !important;
*/
		font-size: 30pt;
		text-align: center;
        vertical-align: middle;

        position: absolute;
        top:0;
        left:0;
        right:0;
        bottom:0;
        display: block;
		opacity: 0;
	}

    #unsplash a span {
		width: 30pt !important;
		height: 50pt !important;
        position: absolute;
        top:0;
        left:0;
        right:0;
        bottom:0;
        margin: auto;
        display: block;
        color: white;
        line-height: 50pt;
        vertical-align: middle;
		transition: 0.3s all ease;
    }

	#unsplash:hover > #unsplash-image{
		opacity: 0.4;
	}
	#unsplash:hover > #unsplash-overlay{
		opacity: 1;
	}
	#unsplash:hover > a {
		opacity: 1;
	}
</style>

<div id="unsplash">
	<div id="unsplash-image" href="http://unsplash.com"></div>
	<div id="unsplash-overlay">
	</div>
    <a target="_blank" href="http://unsplash.com">
        <span class="awesome"></span>
    </a>
</div>
