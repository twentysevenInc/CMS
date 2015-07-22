<?php
include('../../../include/general.php');
include('../../../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>

<style type="text/css">
	.plugin-check-users{
		
	}

	.plugin-check-users li{
		/*border: 1px solid #ddd;*/
		background: #1A222F;
		width: 20rem;
		max-width: 90%;
		display: inline-block;
		padding: 0.5rem;
		margin: 0.5rem;
		border-radius: 0.25em;
	}

	.plugin-check-users li label{
		text-align: left;
		vertical-align: top;
		height: 2rem;
		line-height: 2rem;
	}

	.plugin-check-users li .checkbox{
		float: right;
	}

	.plugin-check-users .plugin-check-users-list{
		width: 100%;
	}

	.plugin-check-users .plugin-check-users-actions{
		margin: 0.5rem;
		width: 100%;
	}
</style>

<script type="text/javascript">

</script>

<div id="add-group">
	<div class="page-header">
		<h1>Cms groups</h1>
		<h4>Choose the groups that can use the Plugin.</h4>
	</div>

	<div class="plugin-check-users">
		<div class="plugin-check-users-list">
		<?php
			$db = new Database;
			$result = $db->query("SELECT name FROM `cms-group`");
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				?>
				<li>
					<label><?php echo $row['name']; ?></label>
					<div class="checkbox onoffswitch maincheckbox">
						<input type='checkbox' name='service' id='checkbox' />
					 <div class="switch"></div>
				</li>
				<?php
			}
		?>
		</div>
		<div class="plugin-check-users-actions">
			<a class="button green-button" href="javascript:void(0);" onclick="">Next</a>
		</div>
	</div>
</div>
