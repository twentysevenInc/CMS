<?php
include('include/general.php');
include('include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
$db = new Database;
?>

<script type="text/javascript">
	function cancel(){
		window.location = window.location;
	}

	function editProfile(src){
		if($(src).attr('action') == 'edit'){
			var arr = document.getElementsByClassName('input-editable');

            $(src).html('<span class = "awesome"></span>Save');
			for (var i = 0; i < arr.length; i++) {

				$(arr).removeAttr('readonly');
				$(arr).removeClass('input-disabled');
			};
//            $('#user-avatar img').css('filter','blur(4px)');
//            $('#user-avatar img').css('-webkit-filter','blur(4px)');

			$(src).attr('action', 'save');
//			$('.delete').css('display', 'none');
			$('#profile-content').append('<a href="javascript:void(0);" onclick="javascript:cancel();" class="button normal-button cancel-edit">Cancel</a>');
		}else{
			//do some fancy ajax
			var arr = document.getElementsByClassName('input-editable');

            $(src).html('<span class = "awesome"></span>Edit Account');
			for (var i = 0; i < arr.length; i++) {

				$(arr).attr('readonly');
				$(arr).addClass('input-disabled');
			};
			$(src).attr('action', 'edit');
//			$('.delete').css('display', 'inline');

			$.ajax({
				type: "POST",
				url: "user/edituser.php",
				data: 'id=' + <?php echo $_SESSION['id']; ?> + "&username=" + $(arr[0]).val() + "&email=" + $(arr[1]).val(),
				success: function(data){
					console.log(data);
					showAlert(
						'Fancy!',
						'Your profile has been updated. You have to login again for it to take action!',
						['Booyah'],
						['normal-button'],
						[function(){ hideAlerts();window.location='logout.php' }]
						);
			  	},
			  	error: function(jqXHR, text, thrown) {
			  		showWarning(
			  			'Uhh Ohh :\'(',
			  			'Something went wrong. Error: ' + text,
			  			['Got it! I\'ll try again', 'Well'],
			  			['green-button', 'normal-button'],
			  			[function(){ hideAlerts(); },function(){ hideAlerts(); }]
			  			);
			  	}
			});
		}
	}
</script>

<div id="profile">
	<div class="profile-header flex-vert">
		<img src="<?php echo $_SESSION['avatar']; ?>" />
		<h2><?php echo $_SESSION['user']; ?></h2>
		<!-- <h2><?php echo $_SESSION['group']; ?></h2> -->
		<a href="mailto:<?php echo $_SESSION['email']; ?>"><?php echo $_SESSION['email']; ?></a>
	</div>

	<div class="profile-actions flex">
		<a href="javascript:void(0)" class="button normal-button">Edit Profile</a>
		<a href="javascript:void(0)" class="button normal-button" onclick="javascript:navigateToWithMenuColorAndActions('user/changePassword.php', '', [['Change Password', 'changePassword();', 'green-button']])">Change Password</a>
		<a href="javascript:void(0)" class="button red-button">Delete Account</a>
	</div>

	<div class="profile-recent-actions">
		<h1>Recent Actions</h1>
		<ul>
			<li>
				<span class="action-table action-table-change">Change</span>
				<span><a href="javascript:void(0)">kimjongun</a> changed his password</span>
			</li>
			<li>
				<span class="action-table action-table-new">New</span>
				<span><a href="javascript:void(0)">kimjongun</a> installed a new Plugin</span>
			</li>
			<li>
				<span class="action-table action-table-bad">OH SHIT!</span>
				<span><a href="javascript:void(0)">juri</a> broke some code</span>
			</li>
			<li>
				<span class="action-table action-table-new">New</span>
				<span><a href="javascript:void(0)">kimjongun</a> is now our glorious leader</span>
			</li>
			<li>
				<span class="action-table action-table-new">New</span>
				<span><a href="javascript:void(0)">kimjongun</a> installed this cms on his server</span>
			</li>
		</ul>
	</div>
</div>


</div>
