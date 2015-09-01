<?php
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/general.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style media="screen">
	#change-user-password form{
		width: 100%;
		padding: 1.5rem;
		margin: 0 0;
	}

	#change-user-password form *{
		/*display: block;
		width: 100%;*/
	}

	#change-user-password form label{
		display: block;
		width: 100%;
	}

	#change-user-password form input{
		margin-bottom: 1rem;
		width: 20rem;
	}

	#change-user-password form label.user-error{
		margin-bottom: 1rem;
		text-transform: none;
		font-size: 16px;
		font-weight: 500;
		color: red;
		width: 20rem;
		margin-left: 1rem;
		display: inline-block;
		letter-spacing: normal;
	}
</style>

<script type="text/javascript">
	function changePassword(){
		var oldPassword = $('#change-user-password input[name="old-password"]').val();
		var newPassword = $('#change-user-password input[name="new-password"]').val();
		var repeatPassword = $('#change-user-password input[name="repeat-password"]').val();

		doAjax('user/ajax/changePassword.php', 'POST', {
			'old-password':oldPassword,
			'new-password':newPassword,
			'repeat-password':repeatPassword
		}, function(data){
			console.log(data);
			data = JSON.parse(data);
			if(data['type'] == 'error'){
				//show error
			}else{
				showAlert(
					'Fancy!',
					'Your password has been updated!',
					['Ok'],
					['normal-button'],
					[function(){ hideAlerts();navigateBack(); }]
					);
			}
		})
	}
</script>

<section id="change-user-password">
	<form>
		<label>Old password</label>
		<input type="password" name="old-password"/>
		<label class="user-error">Error!</label>

		<label>New password</label>
		<input type="password" name="new-password"/>
		<label class="user-error">Error!</label>

		<label>Repeat new password</label>
		<input type="password" name="repeat-password"/>
		<label class="user-error">Error!</label>

		<input type="sumbit" style="display:none;"/>
	</form>
</section>
