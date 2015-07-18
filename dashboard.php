
<?php

include('include/general.php');
include('include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}

  $dat = new Database;
  $result = $dat->query("SELECT widget.name AS widgetName, userDashboard.width, userDashboard.height, plugin.name AS pluginName, widget.reload AS reload FROM `cms-userDashboard` AS userDashboard 
  	INNER JOIN `cms-widget` AS widget ON userDashboard.widgetId = widget.id 
  	INNER JOIN `cms-user` AS user ON userDashboard.userId = user.id 
  	INNER JOIN `cms-plugin` AS plugin ON plugin.id = widget.pluginId WHERE user.id = " . $_SESSION['id'] . " ORDER BY userDashboard.position");

  $dashboard = array();

  while($row = mysql_fetch_object($result)){
    array_push($dashboard, $row);
  }
?>


<style type="text/css">
	#loading {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		margin: auto;
	}
</style>
<!--<style type="text/css">
[draggable] {
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  user-select: none;
   Required to make elements draggable in old WebKit 
  -khtml-user-drag: element;
  -webkit-user-drag: element;
}
.widget {
	cursor: move;
}
.widget-over {
  
}
</style>-->


<!--<script type="text/javascript"> 
	var dragSrcEl = null;
	function handleDragStart(e) {
	 	this.style.opacity = '0.4';
	 	dragSrcEl = this;
	 	e.dataTransfer.effectAllowed = 'move';
		e.dataTransfer.setData('text/html', this.innerHTML);
	}
	function handleDragOver(e) {
	  if (e.preventDefault) {
	    e.preventDefault();
	  }

	  e.dataTransfer.dropEffect = 'move'; 

	  return false;
	}

	function handleDragEnter(e) {
	  this.classList.add('widget-over');
	}

	function handleDragLeave(e) {
	  this.classList.remove('widget-over');
	}
	function handleDrop(e) {
	  	if (e.stopPropagation) {
	  		e.stopPropagation();
	  	}
		if (dragSrcEl != this) {
		    dragSrcEl.innerHTML = this.innerHTML;
		    this.innerHTML = e.dataTransfer.getData('text/html');
		}
	  return false;
	}

	function handleDragEnd(e) {
	  var widgets = document.querySelectorAll('#dashboard .widget');
	  [].forEach.call(widgets, function (widget) {
	    widget.classList.remove('widget-over');
	 	e.target.style.opacity = '1';
	  });
	}

	$(document).ready(function(){
		var widgets = document.querySelectorAll('#dashboard .widget');
		[].forEach.call(widgets, function(widget) {
		  widget.addEventListener('dragstart', handleDragStart, false);
		  widget.addEventListener('dragenter', handleDragEnter, false);
		  widget.addEventListener('dragover', handleDragOver, false);
		  widget.addEventListener('dragleave', handleDragLeave, false);
		  widget.addEventListener('drop', handleDrop, false);
		  widget.addEventListener('dragend', handleDragEnd, false);
		});
	});
</script>-->

<script type="text/javascript">
$(document).ready(function(){
	setTimeout(function(){
		reload(true);
		setInterval(reload, 2000);
	}, 200);
});
function reload(first){
	$('.widget').each(function(index){
		updateWidget(this, first);

		// doAjax("plugins/" + pluginName + ".plugin/widgets/" + widgetName + "/widget.php", "GET", "", function(data){
		// 	$(this).html(data);
		// });

	});

	// doAjax("plugins/Heat.plugin/data.php", "GET", "", function(data){
	// });
}

function updateWidget(widget, first) {
		var pluginName = $(widget).attr("pluginname");
		var widgetName = $(widget).attr("widgetname");
		var reload = $(widget).attr("reload");
		if(reload == 0){
			return;
		}else if(reload == 2){
			$(widget).attr('reload', '0');
		}else if(reload == 3){
			$(widget).attr('reload', '1');
		}

        $.ajax({
          type: 'GET',
          url: "plugins/" + pluginName + ".plugin/widgets/" + widgetName + "/widget.php",
          success: function(data){
          		if(first){
 	         		$(widget).css('opacity', 0);
 	         		// $(widget).fadeOut(200);
 	         	}
				$(widget).html(data);
	      		if(first)
 					$(widget).stop().animate({'opacity':1}, 500);
            }
        });
}
</script>

<div id = "dashboard">
	<!-- <h1>Dashboard</h1>
	<p>Here you go, Sir!</p> -->
	<?php

		if(empty($dashboard)){
			?>
				<h1>No widget added, yet. Go and ad some <a href="#">here</a></h1>
			<?php
		}

		foreach($dashboard as $row){
			echo "<div class=\"widget ";
			if($row->width == 1){
				echo "quarterwidth";
			}
			else if($row->width == 2){
				echo "halfwidth";
			}
			else if($row->width == 3){
				echo "threewidth";
			}
			else{
				echo "fullwidth";
			}

			if($row->height == 1){
				echo " oneheight";
			}
			else if($row->height == 2){
				echo " twoheight";
			}
			else if($row->height == 3){
				echo " threeheight";
			}
			else{
				echo " fourheight";
			}
			$tmpreload = $row->reload + 2;
			echo "\" pluginname='".$row->pluginName."' widgetname='".$row->widgetName."' reload='".$tmpreload."'>";

			?>
				<!-- <img src="img/loading.gif" id = "loading"/> -->
			<?php
			// include 'plugins/' . $row->pluginName . '.plugin/widgets/' . $row->widgetName . '/widget.php';

			echo "</div>";
		}
	?>

</div>