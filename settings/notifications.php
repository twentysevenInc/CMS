<?php
include('../include/general.php');
include('../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style type="text/css">
	#settings-push-header{
		padding: 2rem 1.5rem;
		width: 100%;
		/*background: #eee;*/
	}

	#settings-push-header h1{
		font-size: 2em;
	}

	#settings-push-header h4{
		font-weight: 400;
		color: #888;
	}

	#settings-push-services{
		width: 100%;
		background: #f7426b;
		margin-bottom: 1.5rem;
		text-align: left;
	}

	#settings-push-services *:not(a){
		color: white;
	}

	.settings-push-title-red h4{
		font-weight: 400;
		color: #fff;
		opacity: 0.7;
	}

	.settings-push-list-title{
		margin: 1rem 0;
		margin-left: 2.5rem
	}

	.settings-push-list-title h4{
		font-weight: 400;
		color: #888;
	}

	#settings-push-services img{
		border-radius: 0.25em;
		background: #fff;
		display: inline;
		height: 3rem;
		padding: 1rem;
		margin-right: 0.5rem;
	}

	#settings-push-services .button{
		display: inline-block;
		vertical-align: top;
		margin-top: 0.3rem;
	}

	#settings-push-services-list{
		margin: 1.5rem;
		margin-top: 0;
	}

	/*#settings-push-list .item:nth-of-type(odd){
		background-color: #fff;
		background-color: #e9e9e9;
	}

	#settings-push-list .item:nth-of-type(even){
		background-color: #eee;
	}*/

	.settings-push-content{
		width: 100%;
		display: block;
		margin-top: 0.5rem;
		margin-bottom: 1rem;

		/* Hidden or not */
		/*display: none !important;*/
	}

	.settings-push-content-title{
		padding: 2rem;
		padding-bottom: 1rem;
	}

	.settings-push-content-title{
		width: 100%;
	}

	.settings-push-content-title h3{

	}

	.settings-push-content-title h4{
		font-weight: 400;
		color: #aaa;
	}

	.settings-push-content-choice{
		margin: 1rem;
		margin-top: 0;
	}

	.settings-push-content-choice li{
		width: 10rem;
		display: inline-block;
		padding: 1rem;
		padding-bottom: 0.5rem;
		margin: 0.5rem;
		vertical-align: top;
		border-radius: 0.25rem;
		background: inherit;
	}

	.settings-push-content-choice li:hover{
		background: rgba(0,0,0,0.1);
	}

	.settings-push-content-choice li img{
		width: 100%;
		height: auto;
	}

	.settings-push-content-choice li h3{
		text-align: center;
		font-size: 1em;
		font-weight: 400;
	}

	.settings-push-content-selected{
		border: 1px solid #f7426b !important;
	}
</style>

<div class="page-header">
	<h1>Add Push Services</h1>
	<h4>Add more services that push to a device of your choice</h4>
</div>

<div id="settings-push-services">
	<div class="settings-push-title-red page-subheader">
		<h2>Add Push Services</h2>
		<h4>Add more services that push to a device of your choice</h4>
	</div>
	<div id="settings-push-services-list">
		<img src="img/push/pushover.png">
		<a href="javascript:void(0);" onclick="javascript:showAlert('Todo', 'This work has to be done already!', ['Okay'], ['normal-button'], [function(){hideAlerts();}]);" class="button normal-button">+</a>
	</div>
</div>

<div class="page-subheader">
	<h2>Plugins</h2>
	<h4>Plugins that can push</h4>
</div>
<div class="list">
	<div class="item">
		<input type="text" class="input-disabled" value="Test Plugin" readonly>
		<div class="checkbox">
			<input type='checkbox' name='service' id = 'checkbox" . $row->id . "' onClick='changeCheckbox(" . $row->id . ")'/>
			<div class="switch"></div>
		</div>
		<div class="settings-push-content">
			<!-- <div class="settings-push-content-cms"> -->
				<div class="settings-push-content-title">
					<h3>CMS Push settings</h3>
					<h4>How do you want to be notified by the CMS.</h4>
				</div>
				<div class="settings-push-content-choice">
					<li class="settings-push-content-selected">
						<img src="img/notification/notification-none.png">
						<h3>No notification</h3>
					</li>
					<li>
						<img src="img/notification/notification-fadein.png">
						<h3>Fade in</h3>
					</li>
					<li>
						<img src="img/notification/notification-popup.png">
						<h3>Popup</h3>
					</li>
				</div>
			<!-- </div> -->
		</div>
	</div>

	<div class="item">
		<input type="text" class="input-disabled" value="Transmission Plugin" readonly>
		<div class="checkbox">
			<input type='checkbox' name='service' id = 'checkbox" . $row->id . "' onClick='changeCheckbox(" . $row->id . ")'/>
			<div class="switch"></div>
		</div>
		<div class="settings-push-content">
			<div class="settings-push-content-cms">
				<div class="settings-push-content-title">
					<h3>CMS Push settings</h3>
					<h4>How do you want to be notified by the CMS.</h4>
				</div>
				<div class="settings-push-content-choice">
					<li class="settings-push-content-selected">
						<img src="img/notification/notification-none.png">
						<h3>No notification</h3>
					</li>
					<li>
						<img src="img/notification/notification-fadein.png">
						<h3>Fade in</h3>
					</li>
					<li>
						<img src="img/notification/notification-popup.png">
						<h3>Popup</h3>
					</li>
				</div>
			</div>
		</div>
	</div>

	<div class="item">
		<input type="text" class="input-disabled" value="WG Plugin" readonly>
		<div class="checkbox">
			<input type='checkbox' name='service' id = 'checkbox" . $row->id . "' onClick='changeCheckbox(" . $row->id . ")'/>
			<div class="switch"></div>
		</div>
		<div class="settings-push-content">
			<div class="settings-push-content-cms">
				<div class="settings-push-content-title">
					<h3>CMS Push settings</h3>
					<h4>How do you want to be notified by the CMS.</h4>
				</div>
				<div class="settings-push-content-choice">
					<li class="settings-push-content-selected">
						<img src="img/notification/notification-none.png">
						<h3>No notification</h3>
					</li>
					<li>
						<img src="img/notification/notification-fadein.png">
						<h3>Fade in</h3>
					</li>
					<li>
						<img src="img/notification/notification-popup.png">
						<h3>Popup</h3>
					</li>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="page-subheader">
	<h1>Services</h1>
	<h4>Services that can push</h4>
</div>
<div class="list">
	<div class="item">
		<input type="text" class="input-disabled" value="Test Service" readonly>
		<div class="checkbox">
			<input type='checkbox' name='service' id = 'checkbox" . $row->id . "' onClick='changeCheckbox(" . $row->id . ")'/>
			<div class="switch"></div>
		</div>
		<div class="settings-push-content">
			<div class="settings-push-content-cms">
				<div class="settings-push-content-title">
					<h3>CMS Push settings</h3>
					<h4>How do you want to be notified by the CMS.</h4>
				</div>
				<div class="settings-push-content-choice">
					<li class="settings-push-content-selected">
						<img src="img/notification/notification-none.png">
						<h3>No notification</h3>
					</li>
					<li>
						<img src="img/notification/notification-fadein.png">
						<h3>Fade in</h3>
					</li>
					<li>
						<img src="img/notification/notification-popup.png">
						<h3>Popup</h3>
					</li>
				</div>
			</div>
		</div>
	</div>

	<div class="item">
		<input type="text" class="input-disabled" value="Transmission Service" readonly>
		<div class="checkbox">
			<input type='checkbox' name='service' id = 'checkbox" . $row->id . "' onClick='changeCheckbox(" . $row->id . ")'/>
			<div class="switch"></div>
		</div>
		<div class="settings-push-content">
			<div class="settings-push-content-cms">
				<div class="settings-push-content-title">
					<h3>CMS Push settings</h3>
					<h4>How do you want to be notified by the CMS.</h4>
				</div>
				<div class="settings-push-content-choice">
					<li class="settings-push-content-selected">
						<img src="img/notification/notification-none.png">
						<h3>No notification</h3>
					</li>
					<li>
						<img src="img/notification/notification-fadein.png">
						<h3>Fade in</h3>
					</li>
					<li>
						<img src="img/notification/notification-popup.png">
						<h3>Popup</h3>
					</li>
				</div>
			</div>
		</div>
	</div>

	<div class="item">
		<input type="text" class="input-disabled" value="TransmissionScan Service" readonly>
		<div class="checkbox">
			<input type='checkbox' name='service' id = 'checkbox" . $row->id . "' onClick='changeCheckbox(" . $row->id . ")'/>
			<div class="switch"></div>
		</div>
		<div class="settings-push-content">
			<div class="settings-push-content-cms">
				<div class="settings-push-content-title">
					<h3>CMS Push settings</h3>
					<h4>How do you want to be notified by the CMS.</h4>
				</div>
				<div class="settings-push-content-choice">
					<li class="settings-push-content-selected">
						<img src="img/notification/notification-none.png">
						<h3>No notification</h3>
					</li>
					<li>
						<img src="img/notification/notification-fadein.png">
						<h3>Fade in</h3>
					</li>
					<li>
						<img src="img/notification/notification-popup.png">
						<h3>Popup</h3>
					</li>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

?>
