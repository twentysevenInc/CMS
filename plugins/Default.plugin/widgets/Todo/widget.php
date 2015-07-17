<?php
include('/var/www/cms/include/general.php');
include('/var/www/cms/include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<?php
  // $database = new Database;

  // $itemsQuery = $database->prepare("
  // 	SELECT todo.name, todo.done FROM todo 
  // 	INNER JOIN user ON user.id = todo.user 
  // 	WHERE user.id = :user");

  // $itemsQuery->execute([
  // 		'user' => $_SESSION['id']
  // 	]);

  // $items = $itemsQuery->rowCount() ? $itemsQuery : [];


  $dat = new Database;
  $result = $dat->query("
  	SELECT todo.name, todo.done, todo.id FROM todo 
  	INNER JOIN user ON user.id = todo.user 
  	WHERE user.id = ".$_SESSION['id']);

  $items = array();

  while($row = mysql_fetch_object($result)){
    array_push($items, $row);
  }
?>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<style type="text/css">
	#todo-container {
		background-color: #444;
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
	}
	#todo-container h1 {
		color: white;
		text-align: center;
	}
	#todo-list {
		margin: 1rem;
		overflow: scroll;
		overflow-x: hidden; 
		position: absolute;
		display: block;
		top: 3rem;
		left: 0;
		right: 0;
		height: calc(100% - 8rem);
	}
	.todo-item {
		padding: 0.4rem;
		margin: 0;
		display: block;
		background-color: #353535;
		color: white;
		width: calc(100% - 4rem);
		float: left;
		/*display: table-cell;*/
	}
	#todo-list li:nth-of-type(2n) .todo-item{
		background-color: #2d2d2d;
	}
	#todo-list li:nth-of-type(2n) .todo-done-button, 
	#todo-list li:nth-of-type(2n) .todo-delete-button {
		background-color: #212121;
	}
	#todo-list li:nth-of-type(2n) .todo-done-button:hover, 
	#todo-list li:nth-of-type(2n) .todo-delete-button:hover {
		background-color: #111;
	}
	.todo-done-button {
		float: left;
		background-color: #2b2b2b;
		padding: 0.4rem 0rem;
		margin: 0;
		width: 2rem;
		text-align: center;
		/*display: table-cell;*/
	}
	.todo-done-button i {
		color: #36D7B7;
	}
	.todo-done-button:hover {
		background-color: #111;
	}

	.todo-delete-button {
		background-color: #2b2b2b;
		float: left;
		width: 2rem;
		padding: 0.4rem 0rem;
		margin: 0;
		display: block;
		text-align: center;
		/*display: table-cell;*/
	}
	.todo-delete-button i {
		color: #f7426b;
	}
	.todo-delete-button:hover {
		background-color: #111;
	}

	.todo-done {
		background-color: #666 !important;
		color: #ddd;
		text-decoration: line-through;
	}
	.todo-notdone-button {
		background-color: #555 !important;
	}
	.todo-notdone-button i {
		color: #bbb;
	}
	.todo-notdone-button:hover {
		background-color: #444 !important;
	}
	.todo-notdone-delete-button {
		background-color: #555 !important;
	}
	.todo-notdone-delete-button:hover {
		background-color: #444 !important;
	}


	.todo-item-add{
		padding:0;
		position: absolute;
		bottom: 1rem;
		left: 1rem;
		right: 1rem;
	}
	.todo-item-add input{
		margin: 0;
		box-sizing: border-box;
		float: left;
		padding: 0.4rem;
		font-size: 1rem;
		margin-top: 1.2rem;
	}
	.todo-item-add input[type=text]{
		width: calc(100% - 4rem);
		border-radius: 0;
		border: none;
		background-color: #333;
		color: white;
	}
	.todo-item-add input[type=submit]{
		width: 4rem;
		background-color: #222;
		color: white;
		border: none;
	}
	.todo-item-add input[type=submit]:hover{
		background-color: #111;
	}

</style>

<script type="text/javascript">
// $(document).ready(function(){
// 	$('#textinput').keyup(function(e) {
// 	  $(this).val($(this).val().replace(/[^\w\d\s]/g, ''));
// 	});
// });
</script>

<div id = "todo-container">

	<h1>Todo list</h1>

	<ul id = "todo-list">

		<?php
			foreach ($items as $item) {
		?>
			<li>
				<span class = "todo-item <?php echo $item->done ? ' todo-done' : ''; ?>">
					<?php 
						$tmp = $item->name;
						$tmp = preg_replace('/[<>]*/', '', $tmp); 
						echo $tmp;
					?>
				</span>
				<?php
					if(!$item->done){
					?>
						<a href="plugins/Default.plugin/widgets/Todo/markdone.php?as=done&item=<?php echo $item->id ?>" class = "todo-done-button"><i class="fa fa-check"></i></a>
					<?php
					}else{
					?>
						<a href="plugins/Default.plugin/widgets/Todo/markdone.php?as=notdone&item=<?php echo $item->id ?>" class = "todo-done-button todo-notdone-button"><i class="fa fa-undo"></i></a>
					<?php
					}
				?>
				<a href = "plugins/Default.plugin/widgets/Todo/markdone.php?as=delete&item=<?php echo $item->id ?>" class = "todo-delete-button <?php echo $item->done ? ' todo-notdone-delete-button' : ''; ?>"><i class="fa fa-times"></i></a>
			</li>
		<?php
			}
		?>

	</ul>
	<form class = "todo-item-add" action = "plugins/Default.plugin/widgets/Todo/addtotodo.php" method = "POST">
		<input type = "text" name = "name" placeholder = "type something" autocomplete = "off" id = "textinput" required />
		<input type = "submit" value = "add"/>
	</form>

</div>