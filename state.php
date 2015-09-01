<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<script>
	$(document).ready(function(){
		changeView($('.menu h1 a')[0]);
    });
	function changeView(link){
		$('.menu h1 a').removeClass("active");
		link.className = "active";

		if($(link).attr('data') == 'State'){
			$('#state-content').fadeOut(function(){
                doAjax("components/stateState.php", "GET", null, function(data){
                    $('#state-content').empty();
                    $('#state-content').append(data);
                    $('#state-content').fadeIn();
                });
            });

		}else if($(link).attr('data') == 'Log'){
			$('#state-content').fadeOut(function(){
                doAjax("components/logState.php", "GET", null, function(data){
                    $('#state-content').empty();
                    $('#state-content').append(data);
                    $('#state-content').fadeIn();
                });
            });

		}else if($(link).attr('data') == 'Update'){
			$('#state-content').fadeOut(function(){
                doAjax("components/updateState.php", "GET", null, function(data){
                    $('#state-content').empty();
                    $('#state-content').append(data);
                    $('#state-content').fadeIn();
                });
            });

		}else if($(link).attr('data') == 'Feedback'){
            $('#state-content').fadeOut(function(){
                doAjax("components/feedback.php", "GET", null, function(data){
                    $('#state-content').empty();
                    $('#state-content').append(data);
                    $('#state-content').fadeIn();
                });
            });

        }
	}
</script>


<div>
	<ul class = "menu">
		<h1><a href="javascript:void(0);" onClick="changeView(this)" class="active" data="State">State</a></h1>
		<h1><a href="javascript:void(0);" onClick="changeView(this)" data="Log">Log</a></h1>
		<h1><a href="javascript:void(0);" onClick="changeView(this)" data="Update">Updates</a></h1>
        <h1><a href="javascript:void(0);" onClick="changeView(this)" data="Feedback">Feedback</a></h1>
	</ul>
</div>

<div id = "state-content">
</div>
