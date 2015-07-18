<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style type="text/css">	

#add-group .file-upload{
	width: 100%;
	overflow: auto;
}

#add-group .file-upload form{
	margin: 0.5rem 1rem;
	float: left;
}

#add-group .file-upload .file-upload-error{
	opacity: 0;

	color: red;
	float: right;
	display: inline-block;

	font-weight: 400;
	font-size: 17px;
	margin: 0.5rem 1.2rem;
	padding: 0.4em 1em;
}

#add-group .file-upload .file-upload-success{
	color: #3FC380 !important;
}

#add-group .install-plugin-preview{
	position: relative;
	margin: 1.5rem 1.2rem;
	border: 1px solid #ddd;
	
	border-radius: 0.25em;
	background: #eee;
	display: none;
}

#add-group .install-plugin-preview .install-plugin-header{
	padding: 1rem;
	font-weight: 400;
}

#add-group .install-plugin-preview .install-plugin-actions{
	width: 100%;
	padding: 1rem;
	border-top: 1px solid #ddd;
	overflow: auto;
}
</style>

<script type="text/javascript">

plugin_config = "";

$(document).ready(function (e) {

	$("#plugin-file-upload").on('submit',(function(ex) {
		ex.preventDefault();

		$.ajax({
			url: "settings/settings/manageplugins/lib/upload-plugin.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				data = JSON.parse(data);
				if(data['type'] == 1){
					$('#plugin-upload-error').addClass('file-upload-success');
					$('#plugin-upload-error').html(data['message']);
					$('#plugin-upload-error').animate({
						'opacity':1,
					}, 200);
					readConfig(data['data']);
				}else{
					$('#plugin-upload-error').removeClass('file-upload-success');
					$('#plugin-upload-error').html('Error: ' + data['message']);
					$('#plugin-upload-error').animate({
						'opacity':1,
					}, 200);
				}
			}
		});
	}));
});

function readConfig(data){
	plugin_config = data;

	var title = data['name'];
	var author = data['author'];
	var version = data['version'];

	$('#add-group .install-plugin-preview .install-plugin-header .title').html(title);
	$('#add-group .install-plugin-preview .install-plugin-header .author').html(author);
	$('#add-group .install-plugin-preview .install-plugin-header .version').html("Version " + version);

	$('#add-group .install-plugin-preview').fadeIn();
}

function installCmsPlugin(){
	doAjax('settings/settings/manageplugins/lib/make-install.php',
		'POST',
		"data="+JSON.stringify(plugin_config),
		function(data){
			console.log(data);
			data = JSON.parse(data);
			if(data['type'] == 1){
				navigateTo('settings/settings/manageplugins/add-group.php');
			}
		});
}

</script>


<div id="add-group">
	<div class="page-header">
		<h1>Install a Plugin</h1>
		<h4>Please upload your Plugin.zip to install it.</h4>
	</div>

	<div class="file-upload">
		<form id="plugin-file-upload" enctype="multipart/form-data" action="">
			<input type="file" placeholder="Plugin.zip" name="file" required />
			<input type="submit" value="Upload" class="button green-button"/>
		</form>
		<h4 class="file-upload-error" id="plugin-upload-error">Error: Everyday I’m shuffeling!</h4>
	</div>

	<div class="install-plugin-preview">
		<div class="install-plugin-header">
			<h1 class="title"></h1>
			<h4 class="author"></h4>
			<h4 class="version"></h4>
		</div>
		<div class="install-plugin-actions">
			<a href="javascript:void(0);" class="button green-button" onclick="installCmsPlugin();">Install</a>
		</div>
	</div>
</div>
