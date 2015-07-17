<style>

<?php

/*
	Profile
*/

$profileSectionBackground = "#eee";
$profileSectionBorder = "#fff";


include('include/general.php');
include('include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
$db = new Database;

?>

	#profile .edit{
		opacity: 0;
	}

	#profile form {
		display: inline-block;
	}

	#profile-content{
		padding: 1%;
		/*margin-bottom: 1%;*/
	}

	.profile-blob{
		float: left;
		width: 48%;
		margin: 1%;
		padding: 1rem;
		background: <?php echo $profileSectionBackground; ?>;
		border: 2pt solid <?php echo $profileSectionBorder; ?>;
		text-align: center;
		overflow: auto;
	}

	#main-profile img{
		display: block;
		border-radius: 50%;

		position: absolute;
        top: 0;
        bottom:0;
        left:0;
        right:0;
		margin: auto;
	}

	#profile-content input{
		margin: 0.2em;
/*		float: left;*/
		width: 60%;
	}

	#profile-content label{
		margin: 0.2em;
		float: left;
		text-align: left;
		width: 30%;
		display: inline;
	}

	#profile-content h1{
		padding-top: 0.75em;
		padding-bottom: 1.5em;
	}

	#profile-content li{
		clear: both;
		padding-top: 2rem;
		padding-bottom: 1rem;
/*		text-align: right;*/
	}

	#profile-content a{
		display: inline;
	}

	#profile-content #main-profile #user-avatar {
		position: relative;
        width: 14rem;
        display: block; 
        height: 20rem;
	}

	#profile-content .profile-blob #user-avatar img:after {
		position: absolute;
		display: block;
		background-color: #069;
		content: 'edit';
	}
    
    #main-profile {
        background-color: #333;
        display: block;
        overflow: hidden;
        
        position:relative;
        
        display: table;
        border-radius: 6px 0 0 6px;
        
        background-color: #fff;
        
        width:100%;
    }
    
    #main-profile #user-avatar img{
		display: block;
		border-radius: 50%;

        height: 8rem;
        
/*        margin: 4rem 4rem;*/
        float:left;
        
/*
        -webkit-box-shadow: 0 0 0 3pt #fff, 0 0 0 4pt #ddd;
        box-shadow: 0 0 0 3pt #fff, 0 0 0 4pt #ddd;
*/
/*
        -webkit-box-shadow: 0 0 10px -4px #000000;
        box-shadow: 0 0 10px -4px #000000;
*/
    }
    
	#profile-infos{
        background-color: #444;
        color: white;
        display:block;
        overflow:hidden;
        
        display: table-cell;
        vertical-align: middle;
        text-align:left;
        margin: 0;
        
        border-radius: 0 6px 6px 0;
        
        background-color: #fff;
        color: #111;
	}
    
    
	#profile-infos input{
/*		float: left;*/
        margin-left: 0;
        padding-left: 0.4rem;
	}
    
	#nameinput{
        font-size:4rem;
	}
    
    #heyyou {
        font-size:4rem;
        font-weight: bold;
    }
    
    #profile-actions {
        width: 100%;
        text-align: center;
        width: 37rem;
        padding: 0.6rem;
        
        border: 1px solid #f0f0f0;
        border-radius: 6px;
    }
    #profile-actions li{
        display: inline-block;
        width: 9rem;
        text-align: center;
        margin: 0 -2px;
        padding: 0;
        
        border-right: 1px solid #f0f0f0;
    }
    #profile-actions li a{
        width:100%;
        padding: 2rem 0;
        display: block;
    }
    #profile-actions li a span{
        display: block;
        font-size: 2rem;
        margin-bottom: 0.4rem;
        opacity: 0.69;
    }
    #profile-actions li a:hover{
        background-color: #f0f0f0;
    }
    #profile-actions li:last-of-type{
        border-right: none;
    }
    
    .cancel-edit {
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

/*
    #main-profile #user-avatar img{
        filter: blur(2px);
        -webkit-filter: blur(2px);
    }
*/

	@media (max-width: 320pt) {
		.profile-blob{
			width: 98%;
		}

		#profile-content input{
			width: 50%;
		}

		#profile-content label{
			width: 45%;
		}
	}
</style>

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
<!--
	<div class="menu">
		<h1>Profile</h1>
		<a href="javascript:void(0);" onclick="javascript:editProfile(this);" class="button normal-button">Edit User</a>
		<a href="javascript:void(0);" onclick="javascript:showWarning('Are you sure?', 'This user will be deleted permanently! (not yet)', ['Go ahead', 'Cancel'], ['red-button', 'normal-button'], [function(){hideAlerts();}, function(){hideAlerts();}]);" class="button red-button delete">Delete User</a>
	</div>
-->


	<div id="profile-content">
		<div id="main-profile">
			<div id = "user-avatar">
				<img src=<?php echo "\"".$_SESSION['avatar']."\""; ?>/>
			</div>
            
            <div id = "profile-infos">
                <div id="heyyou">
                    Hey, 
                    <input id = "nameinput" type='text' value='<?php echo $_SESSION['user']; ?>' class='input-disabled input-editable' readonly/>
                
            </div>
			
			<!--
				$result = $db->query("SELECT  `group`.name, user.email FROM  `group` INNER JOIN user ON ( user.groupId =  `group`.id ) ");
				if($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					echo "<input type='text' value='".$row['email']."' class='input-disabled input-editable' readonly/>";
				}
			
                <span>
			
                echo $row['name'];
//				echo "<input type='text' value='".$row['name']."' class='input-disabled' readonly/>";
			     </span>-->
            </div>
		</div>
        
        <ul id="profile-actions">
            <li>
                <a href="javascript:void(0);" onclick="javascript:editProfile(this);" action="edit"><span class = "awesome"></span>Edit Account</a>
            </li>
            <li>
                <a href="#"><span class = "awesome"></span>Change Password</a>
            </li>
            <li>
                <a href="#"><span class = "awesome"></span>Something</a>
            </li>
            <li>
                <a href="#"><span class = "awesome awesome-red"></span>Delete Account</a>
            </li>
        </ul>

<!--
		<div class="profile-blob">
			<h1>Change Password</h1>
			<label>Old Password</label>
			<input type='password'/>
			<label>New Password</label>
			<input type='password'/>
			<label>Repeat</label>
			<input type='password'/>
			<li>
				<a href="javascript:void(0);" onclick="javascript:showAlert('Todo', 'This work has to be done already!', ['Okay'], ['normal-button'], [function(){hideAlerts();}]);" class="button green-button">Change</a>
			</li>
		</div>
-->
	</div>
</div>

	
</div>