<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<?php

// $json = json_decode(file_get_contents("settings.json"), true);
// $settings = $json["settings"];
//
// for ($i = 0; $i < count($settings); $i++) {
// 	// echo "settings/".$settings[$i]['path']."/module.css";
// 	$css = file_get_contents("".$settings[$i]['path']."/module.css");
// 	$content = file_get_contents("".$settings[$i]['path']."/module.php");
// 	echo "<style type=\"text/css\">\n".$css."\n</style>'";
// 	echo $content;
// }

?>

<script>
$(document).ready(function(){
	setAdmin();
});

function setAdmin(){
	  $('#settings-content').fadeOut(function(){
			$('#settings-content').empty();
			$.getJSON( "settings/settings.json", function(data) {
				 var data = data['settings'];
				 var arr = [];
				 $.each( data, function( key, val ) {
					  arr.push(val);
				 });
				 arr.sort(compare);

				 for (var i = arr.length - 1; i >= 0; i--) {

					  $.ajax({
							url: 'settings/'+arr[i]['path']+'/module.css',
							type: 'GET',
							async: false,
							success: function(result) {
								 $('#settings-content').append('<style type="text/css">\n'+result+'\n</style>');
							}
					  });
					  $.ajax({
							url: 'settings/'+arr[i]['path']+'/module.php',
							type: 'GET',
							async: false,
							success: function(result) {
								 $('#settings-content').append('<div class="settings-table"> \n'+result+' \n</div>');
							}
					  });
				 };
				 $('#settings-content').fadeIn();
			});
	  });
}
</script>
