<?php
include('../include/general.php');
include('../include/database.php');
if(!checkLogin()){
	header("Location: login.html");
}
?>
<style>

#main-state {
    text-align: center;
    font-size: 2.4em;
    padding: 0.5em 0;
    margin-bottom: 2.75rem;
}

.state-check {
    color: #4CD964;
    height: 1em;
    margin-right: 0.2em;
}

.state-check-error {
    color: #FF3B30;
}

.state-table{
    width: 100%;
    border-collapse: collapse;
}

.state-table td{
    padding: 0.75em 0.5em;
}

.state-table tr:nth-of-type(even) {
    background: #fff;
}

.state-table tr:nth-of-type(odd) {
    background: #eee;
}
    
#check-system-button {
    float: right;
    font-weight: normal;
}
    

@media (max-width: 320pt) {
    .state-table td{
        display:block;
    }
    .state-table td:nth-of-type(even){
        background: #fff;
    }
    .state-table td:nth-of-type(odd){
        background: #eee;
    }
}

</style>

<?php
    $checksystemnowtext = 'Check system now';
?>
<script>
    function checkSystem(){
        $('#check-system-button').html('<img src="img/loading.gif"/>');
        doAjax("checkSystem/checkSystem.php", "GET", null, function(data){
            $('#state-content').fadeOut(function(){
                changeView($('.active'));
                $('#state-content').fadeIn(function(){
                    showAlert(
                        'Fancy!',
                        'CMS state check just finished!',
                        ['Okay','Show me!'],
                        ['normal-button','normal-button'],
                        [function(){ hideAlerts();},function(){ hideAlerts();changeView($('.menu h1:first-of-type a'));}]
                        );
                });
            });
        });
    }
</script>

<?php
    $string = file_get_contents("/var/www/cms/checkSystem/systemstatus.json");
    $json_a = json_decode($string,true);
?>

<div id = "sys-state">
    <div class="page-header">
        <h1>CMS State<a class="button normal-button" id = "check-system-button" href="javascript:void(0)" onclick="checkSystem()"><?php echo $checksystemnowtext;?></a></h1>
        <h4>Problems and errors found by the CMS are listed here</h4>
    </div>
    <h1 id = "main-state">
        <?php
        $everythingok = true;
        foreach ($json_a as $key => $value){
            if(strcmp($value,'false')==0){
                $everythingok = false;
            }
        }
        
        if($everythingok){
            ?><span class="awesome state-check"></span>everything seems great<?php
        }else{
            ?><span class="awesome state-check state-check-error"></span>it seems like something's not working<?php
        } 
        ?>
    
    </h1>
    <table class="state-table">
        
        <tr>
        <?php

            $i = 1;

            foreach ($json_a as $key => $value){
                ?><td><span class="awesome state-check
                <?php 
                    if(strcmp($value,'true')!=0){
                        echo ' state-check-error';
                    }
                ?>
                ">
                <?php
                    if(strcmp($value,'true')==0){
                        echo '';
                    }else{
                        echo '';
                    }
                ?>
                </span><?php echo $key; ?></td><?php
                
                if($i%4==0){
                    ?></tr><tr><?php
                }
                $i++;
            }
        ?>
        </tr>
    </table>
</div>
