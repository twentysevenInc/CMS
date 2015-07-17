<style type="text/css">
	#sys-log .log-div{
		/*background: #eee;*/
		border-top: 1pt solid #eee;
		padding: 1em;
		line-height: 1.4em;
	}
	#sys-log .log-div, #sys-log span{
		font-family: "Office Code Pro", monospace;
	}
    
    #delete-log-button  {
/*
        float: right;
        font-weight: normal;
*/
        position:absolute;
        right: 1rem;
        top: 7rem;
        font-size: 2rem;
    }
    
</style>

<script>
    function deleteLog(){
        $('#delete-log-button').effect( "shake" );
        doAjax("components/deletelog.php", "GET", null, function(data){
            changeView($('.active'));
        });
    }
</script>

<div id = "sys-log">
	<section id = "settings-content">
        <a href='#' class='awesome awesome-red' id="delete-log-button" onclick='deleteLog();'></a>
		<div class="page-header">
			<h1>CMS Log</h1>
			<h4>Important stuff to debug the CMS</h4>
		</div>
		<div class="log-div"><?php
			function startsWith($haystack, $needle)
			{
			    return $needle === "" || strpos($haystack, $needle) === 0;
			}

			$f = fopen('../cms.log', 'rt');

			while (!feof($f)) {
			    $line = rtrim(fgets($f), "\n");
			    // $info = explode('*', $line);
			    if(startsWith($line, "err"))
			    	echo "<span style='color:#FB7070'>".preg_replace("/err/", "", $line, 1)."</span>"."<br/>";
			    else
			    	echo "<span style='color:#2b2b2b'>".preg_replace("/log/", "", $line, 1)."</span>"."<br/>";
			}

			fclose($f);

			//echo file_get_contents('cms.log'); ?></div>
	</section>
</div>
