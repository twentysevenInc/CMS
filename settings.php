<?php

?>

<script type="text/javascript">
	$(document).ready(function(){
		changeView($('.menu h1 a')[0]);
	});


	function doAjaxRequest(url, type, data){
		var ret;
		if (data) {
			$.ajax({
				type: type,
				url: url,
				data: data,
				async: false,
				success: function(data){
					ret = data;
				},
				error: function (request, status, error) {
					ret = request;
				}
			});
		}else{
			$.ajax({
				type: type,
				url: url,
				async: false,
				success: function(data){
					ret = data;
				},
				error: function (request, status, error) {
					ret = request;
				},
				complete: function (jqXHR, textStatus) {
					// $('#overlay').fadeOut();
				},
				beforeSend: function (jqXHR, settings) {
					// $('#overlay').fadeIn();
				}
			});
		};
		return ret;
	}

	function compare(a,b) {
		if (a['id'] > b['id'])
			return -1;
		if (a['id'] < b['id'])
			return 1;
		return 0;
	}

	function setAdmin(){
        $('#settings-content').fadeOut(function(){
            $('#settings-content').empty();
            $.getJSON( "components/settings.json", function(data) {
                var data = data['settings'];
                var arr = [];
                $.each( data, function( key, val ) {
                    arr.push(val);
                });
                arr.sort(compare);

                for (var i = arr.length - 1; i >= 0; i--) {

                    $.ajax({
                        url: 'components/'+arr[i]['path']+'/module.css',
                        type: 'GET',
                        async: false,
                        success: function(result) {
                            $('#settings-content').append('<style type="text/css">\n'+result+'\n</style>');
                        }
                    });
                    $.ajax({
                        url: 'components/'+arr[i]['path']+'/module.php',
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

	function changeView(link){
		$('.menu h1 a').removeClass("active");
		link.className = "active";

		if($(link).attr('data') == 'CMS'){
			setCookie('settings', 'CMS', 69);
			$('#settings-content').fadeOut(function(){
                $('#settings-content').empty();
                
                var data = doAjaxRequest("components/cmsSettings.php", "GET");
                $('#settings-content').append(data);
                $('#settings-content').fadeIn();
            });

		}else if($(link).attr('data') == 'Plugins'){
			setCookie('settings', 'Plugins', 69);
			$('#settings-content').fadeOut(function(){
                $('#settings-content').empty();
                
                var data = doAjaxRequest("components/pluginSettings.php", "GET");
                $('#settings-content').append(data);
                $('#settings-content').fadeIn();
            });

		}else if($(link).attr('data') == 'Notifications'){
			setCookie('settings', 'Notifications', 69);
			$('#settings-content').fadeOut(function(){
                $('#settings-content').empty();
                
                var data = doAjaxRequest("components/notificationSettings.php", "GET");
                $('#settings-content').append(data);
                $('#settings-content').fadeIn();
            });

		}else if($(link).attr('data') == 'Admin'){
			setCookie('settings', 'Admin', 69);
			setAdmin();
		}else if($(link).attr('data') == 'Profile'){
			setCookie('settings', 'Profile', 69);
			setCookie('settings', 'CMS', 69);
			$('#settings-content').fadeOut(function(){
                $('#settings-content').empty();
                var data = doAjaxRequest("user.php", "GET");
                $('#settings-content').append(data);
                $('#settings-content').fadeIn();
            });
		}
	}
</script>

<style type="text/css">
	#settings-content{
		position: relative;
	}

	#settings-content div{
		display: inline-block;
	}
</style>

<div id = "settings">
	<ul class = "menu">
		<!-- <h1><a href="javascript:void(0);" onClick="changeView(this)" data="Profile">Profile</a></h1> -->
		<h1><a href="javascript:void(0);" onClick="changeView(this)" class="active" data="CMS">CMS</a></h1>
		<h1><a href="javascript:void(0);" onClick="changeView(this)" data="Plugins">Plugins</a></h1>
		<h1><a href="javascript:void(0);" onClick="changeView(this)" data="Notifications">Notifications</a></h1>
		<h1><a href="javascript:void(0);" onClick="changeView(this)" data="Admin">Admin</a></h1>
	</ul>

	<section id = "settings-content">
	</section>
</div>
