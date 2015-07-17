<?php

include('include/general.php');
include('include/database.php');
if(!checkLogin()){
  header("Location: login.html");
}

  $dat = new Database;
  $result = $dat->query("SELECT name, id, ip FROM service ORDER BY name");

  $services = array();

  while($row = mysql_fetch_object($result)){
    array_push($services, $row);
  }
?>


<head>
<title>CMS</title>
 
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1, maximum-scale=1, minimum-scale=1.0">
 
<style>

<?php
  /*
    Add Service
  */
  $addServiceNameBorder = "#ccc";
  $addServiceBackground = "#446CB3";

  /*
    Services
  */

  $serviceListOddColor = "#fff";
  $serviceListEvenColor = "#f2f2f2";

  $serviceStandardStatusBackground = "#ccc";

  $editNameBorder = "rgba(0,0,0,0)";
  $editNameBackground = "rgba(0,0,0,0)";


  /*
    Service Settings CSS
  */

  $serviceSettingsSectionBackground = 'rgba(0,0,0,0)';
  $serviceSettingsDescriptionBackground = "#f5f5f5";
?>

  #serv .service {
    width: 100%;
    padding: 1rem 0;
    padding-bottom: 0.5rem;
    text-align: center;
    text-align: left;
    display: block;
    overflow: auto;
  }

  #serv .service:nth-of-type(even){
    background-color: <?php echo $serviceListEvenColor; ?>;
  }

  #serv .service:nth-of-type(odd){
    background-color: <?php echo $serviceListOddColor; ?>;
  }

  #serv .service .status {
    width: 0.8em;
    height: 0.8em;
    margin-top: 0.4em;
    margin-right: 1rem;
    margin-left: 0.75rem;
    border-radius: 100%;
    background-color: <?php echo $serviceStandardStatusBackground; ?>;
    float: left;
  }
  #serv .service .maincheckbox {
    margin-top: -0.25rem;
    margin-right: 0.2rem;
    float: right;
  }

  #serv .service .settings{
    display: none;
  }

  #serv .service .delete{
    float: right;
    margin-top: -0.4em;
    width: 0;
    overflow: hidden;
    text-align: center;
    transition: 0.15s background ease;
    padding: 0.5rem 0;
    margin-bottom: 0;
    border: none;
  }

  #serv .service .advanced{
    float: right;
    margin: 0 1em;
    margin-top: 0.12rem;
    vertical-align: bottom;
    height: 100%;
  }

  #serv .service .advanced .awesome :hover{
    opacity: 0.5;
    transition: 0.15s all ease;
  }

  #serv .edit, #serv .editname, #addservice input[type="text"]{
    display: inline-block;
    margin-top: -0.4em;
  }
  #serv .edit{
    display: none;
  }
  #serv .editname{
    opacity: 1;
    background-color: <?php echo $editNameBackground; ?>;
    border: 0.5px solid <?php echo $editNameBorder; ?>;
    display: inline-block;
    width: auto;
  }

  #serv form {
    float: left;
  }

  #serv .service .save{
    display: none;
  }

  #serv .service .save, #addservice input[type="submit"]{
    margin-top: -0.4em;
  }

  #addservice input[type="submit"] {
    display: inline-block;
  }

  #addservice {
    height: 0;
    /*border-bottom: 2pt solid #eee;*/
    overflow: hidden;
    display: block;
    background-color: <?php echo $addServiceBackground; ?>;
  }
  #addservice input{
    display: inline-block;
    margin-top: 4rem;
    display: block;
    opacity: 1;
  }
  #addservice input:first-of-type{
    margin-left: 1rem;
    border: 0.5px solid <?php echo $addServiceNameBorder; ?>;
  }
  #serv .service .service-error {
    color: red;
    font-size: 0.8rem;
  }
  #serv .service .service-settings {
    display: none;
    clear: both;
  }

  /*#serv .service:nth-of-type(even) .service-settings{
    border-top: 2pt solid <?php echo $serviceListOddColor; ?>;
  }

  #serv .service:nth-of-type(odd) .service-settings{
    border-top: 2pt solid <?php echo $serviceListEvenColor; ?>;
  }*/

  #serv .service .service-settings-section {
    background-color: <?php echo $serviceSettingsSectionBackground; ?>;
    margin-left: 4%;
    margin-top: 2em;
  }

  #serv .service .service-settings-section h3{
    font-size: 1.5rem;
  }

  #serv .service .service-settings-section input[type="checkbox"]:checked{
    background-color: #888;
  }
  #serv .service .service-settings-section input[type="checkbox"]{
    background-color: #111;
  }
  #serv .service .service-settings-section input[type="range"]{
    background-color: #111;
    border-radius: 0.5rem;
    height: 1rem;
    padding: 0.1rem;
  }
  input[type=range]::-webkit-slider-thumb {
    height: 2rem;
    width: 2rem;
    background-color: #fff;
  }
  input[type=range]::slider-thumb {
    height: 2rem;
    width: 2rem;
    background-color: #fff;
  }
  .service-settings-element {
    margin: 0.8em 0;
  }
  .service-settings-element h4 {
    min-width: 10em;
    display: inline-block;
  }
  .service-settings-element select {
    padding: 0.2em;
  }
  .service-settings-description {
    max-width: 20rem;
    background-color: <?php echo $serviceSettingsDescriptionBackground; ?>;
    padding: 0.5em;
    margin-left: 0;
    margin: 0.5em 0;
    display: none;
  }
  .save-service-settings {
    display: none;
    float: right;
  }
  .service-settings-error {
    margin-left: 1rem;
  }

  .service-version {
    float: right;
    margin: 1rem;
    color: #bbb;
  }

  /*.getup {
    margin-top: -0.6em !important;
  }*/

  @media (max-width: 500pt) {
    .service-error{
      display: none !important;
    }

    #serv form{
      display: inline;
      width: 50%;
      float: left;
    }

    #serv .service form input{
      float: right;
    }

    #serv .service form input[type="text"]:first-of-type(){
      margin-top: -0.4em;
    }

    #serv .service form input:not(:first-of-type){
      margin-top: 0.4em;
    }

    .status{
      display: none;
    }
  }
</style>

<script>

var redColor = '#f7426b';
var greenColor = '#00B16A';
var greyColor = '#ddd';

  function requestStatus(request, id, done){
      $.ajax({
        type: "POST",
        url: "services/communicate.php",
        data: 'q=' + JSON.stringify(request),
        contentType: "application/x-www-form-urlencoded; charset=utf-8",
        success: function(data){
          // console.log(data);
            if(JSON.parse(data)['response'] == 'STOPPED'){
              document.getElementById('c' + id).style.backgroundColor = redColor;
              document.getElementById('checkbox' + id).checked = false;
            }else if(JSON.parse(data)['response'] == 'ACTIVE'){
              document.getElementById('c' + id).style.backgroundColor = greenColor;
              document.getElementById('checkbox' + id).checked = true;
            }else if(JSON.parse(data)['response'] == 'FAILED'){
              document.getElementById('c' + id).style.backgroundColor = greyColor;
              document.getElementById('checkbox' + id).checked = false;
            }

            if(JSON.parse(data)['error']){
              $(document.getElementById('error' + id)).text(JSON.parse(data)['error']);
            }else{
              $(document.getElementById('error' + id)).text('');
            }
          }
        }).done(done);
  }

  function loadStatuses(services){

    var datarray = [];
    for (var i = 0; i < services.length; i++) {
        datarray.push({
            request : "STATUS",
            serviceurl : services[i]["ip"]
        });
    }

    var tmp = []

     for (var i = 0; i < datarray.length; i++) {
      var id = services[i]["id"];
      requestStatus(datarray[i], id);
    }
  }

  $(document).ready(function() {
    loadStatuses(services);
    window.setInterval(function(){
      loadStatuses(services);
    }, 5669);
  });
</script>

<script type="text/javascript">
  function changeCheckbox(id){
    $('#overlay').fadeIn();
    for (var i = services.length - 1; i >= 0; i--) {
      if(services[i]['id'] == id){
        var request = {
                request : (document.getElementById('checkbox'+id).checked)?"START":"STOP",
                serviceurl : services[i]["ip"]
            };
        requestStatus(request, id, function() {
            $('#overlay').fadeOut();
          });
      }
    };
    // $.get("updateService.php");
  }

  function edit(button){
    if($('.delete').width() == '0'){
      /*
      $('.delete').animate({
        width: '0'
      }, 200);


      $('.editname').animate({
        backgroundColor: 'rgba(0,0,0,0)',
        borderColor: 'rgba(255,255,255,0.01)'
      }, 100).attr("readonly", "readonly");

      $('.edit').fadeOut(200);
      $('.save').fadeOut(100, function(){
        $('.service-error').delay(200).fadeIn();
      });


      $(button).text('Edit');
      button.previousElementSibling.style.display = 'inline-block';

      $('.advanced').fadeIn(200);
      $('.onoffswitch').fadeIn(200);*/

      /* end */

      $('.delete').animate({
        width: '5rem'
      }, 200, function(){
      });

      $('.editname').animate({
        backgroundColor: '#fff',
        borderColor: '#ccc'
      }, 100).removeAttr("readonly");

      $('.service-error').fadeOut(100, function(){
        $('.save').fadeIn(200);
        $('.edit').fadeIn(200);
      });

      $(button).text('Done');
      button.previousElementSibling.style.display = 'none';

      $('.advanced').fadeOut(200);
      $('.onoffswitch').fadeOut(200);
    }else{

      $('.delete').animate({
        width: '0'
      }, 200);

      $('.editname').animate({
        backgroundColor: 'rgba(0,0,0,0)',
        borderColor: 'rgba(255,255,255,0.01)'
      }, 100).attr("readonly", "readonly");

      $('.edit').fadeOut(200);
      $('.save').fadeOut(100, function(){
        $('.service-error').delay(200).fadeIn();
      });


      $(button).text('Edit');
      button.previousElementSibling.style.display = 'inline-block';

      $('.advanced').fadeIn(200);
      $('.onoffswitch').fadeIn(200);
    }
  }

  function add(button){
    if($('#addservice').height() == '0'){
      $('#addservice').animate({
        'min-height': '5rem',
        'padding-top': '1.7rem',
      }, 200).css('height', 'auto');
      $(button).text('Cancel');
      button.nextElementSibling.style.display = 'none';
    }else{
      $('#addservice').animate({
        'min-height': '0',
        'height': '0',
        'padding-top': '0'
      }, 200);
      $(button).text('Add Service');
      button.nextElementSibling.style.display = 'inline-block';
    }
  }

  function deleteServiceById(id){
    $.ajax({
      type: 'POST',
      url: 'services/deleteservice.php',
      data: 'id=' + id
      }).done(function(msg) {
          $('#service' + id).animate({
            height: '0',
            borderBottom: 'none'
          }, 200, function(){
            $('#service' + id).remove();
          });
      });
  }

  function deleteService(id){
    for (var i = services.length - 1; i >= 0; i--) {
      if(services[i]['id'] == id){
        idtodelete = id
        showWarning('Delete service "' + services[i]['name'] + '"?', 
                  'Are you sure, you want to delete this service?',
                  ['Delete','Abort'],
                  ['red-button','normal-button'],
                  [
                    function(){
                      deleteServiceById(idtodelete);
                      // edit(function(){return $('.menu:nth-child(2)');});
                      edit(document.getElementsByClassName('menu')[0].children[2]);
                      hideAlerts();
                    },
                    function(){
                      hideAlerts();
                    }
                  ]
                );
      }
    }
  }

  oldsettings = {}
  function showSettings(id) {
    var settingsElement = '#service-settings' + id;
    try{
      // console.log('Y U NO WORK?!');
      if($(settingsElement).css('display') == 'block'){
        $(settingsElement).css('display', 'none');
        $('#service' + id).find('.advanced').html('').removeClass('getup');
        $('.save-service-settings').css('display','none');
        $('#service' + id).find('.onoffswitch').css('display','block');
      }else{
        $(settingsElement).css('display', 'block');
        $('#service' + id).find('.advanced').html('<div class = "button normal-button">Cancel</div>').addClass('getup');
        $('#service' + id).find('.onoffswitch').css('display','none');

        for (var i = services.length - 1; i >= 0; i--) {
          if(services[i]['id'] == id){
            console.log("ip: " + services[i]["ip"]);
            var request = {
                    request : "SETTINGS",
                    serviceurl : services[i]["ip"]
                };

            $.ajax({
              type: 'POST',
              url: 'services/communicate.php',
              data: 'q=' + JSON.stringify(request),
              contentType: "application/x-www-form-urlencoded; charset=utf-8",
              success: function(data){
                  console.log(data);
                  var response = JSON.parse(data);
                  oldsettings[id] = response;
                  var content = "";
                  if(response['response'] == 'FAILED'){
                    content = '<div class = "service-settings-error">Failed to load Settings! (' + response['error'] + ')</div>';
                  }else if(response['response'] == 'SETTINGS'){

                    if(response['settings']['version']){
                      content += "<div class = 'service-version'> version " + response['settings']['version'] + "</div>";
                    }

                    var sections = response['settings']['sections'];

                    for (var i = 0; i < sections.length; i++) {
                      var section = sections[i];

                      content += '<div class = "service-settings-section">';
                      if(section['title']){
                        content += '<h3>' + section['title'] + '</h3>';
                      }

                      var sectionContent = section['content'];
                      for (var j = 0; j < sectionContent.length; j++) {
                        content += "<div class='service-settings-element'>";
                        var element = sectionContent[j];
                        content += "<h4>" + element['title'] + "</h4>";

                        switch(element['type']){
                          case 'number-field':
                            content +=  '<input type = "number" value = "' +  element['value'] + '"';
                            if(element['min']){
                              content += ' min="' + element['min'] + '"';
                            }
                            if(element['max']){
                              content += ' max="' + element['max'] + '"';
                            }
                            content += '/>';
                            break;
                          case 'number-slider':
                            content += '<input type="range"  min="'+element['min']+'" max="'+element['max']+'" value = "'+element['value']+'" />';
                            break;
                          case 'text':
                            content += '<input type = "text" value = "' +  element['value'] + '"/>';
                            break;
                          case 'checkbox':
                            var ckbx = "<div class='checkbox onoffswitch'> <input id = 'settings_checkbox_" + i + "_" + j + "' type = 'checkbox' ";
                            if(element['value'] == 'true'){
                              ckbx += "checked='checked'";
                            }
                            ckbx += "/> <div class='switch'></div> </div>";
                            content +=  ckbx;
                            break;
                          case 'dropdown':
                            content += "<select>";
                            for (var k = 0; k < element['values'].length; k++) {
                              var tmpValue = element['values'][k];
                              content += "<option ";
                              content += (element['value']==tmpValue)?"selected='true'":"";
                              content += " >" + tmpValue + "</option>"
                            };
                            content += "</select>";
                            break;
                        }
                        if(element['description']){
                          content += '<div class="service-settings-description">' + element['description'] + '</div>';
                        }
                        content += "</div>";
                      }


                      content += '</div>';
                    };
                    $('#service' + id).find('.save-service-settings').css('display','block');
                  }else{
                    content = "Well. I don't know, what is going on man!"
                  }
                  $(settingsElement).html(content);
                }
              });
          }
        }
      }
    }catch(err){
      $(settingsElement).html("Error loading settings! (" + err.message + ")");
    }
  }

  function saveSettings(id){
    // console.log('------ saveSettings ------')
    var settingsElement = document.getElementById('service-settings' + id);

    var settings = oldsettings[id]['settings'];
    var sections = settings['sections'];

    var count_section = 0;

    $("#service" + id + " .service-settings-section").each(function() {
      var count_element = 0;

      $(this).find('.service-settings-element').each(function() {
        var input = $(this).find($('input'));
        var type = $(input).attr('type');

        var value;
        if(type == undefined){
          value = $(this).find('option:selected').text();
        }else if(type == 'checkbox'){
          var right_checkbox = document.getElementById($(input).attr('id'));
          value = right_checkbox.checked;

          // if(value == 'checked'){
          //   value = true;
          // }else{
          //   value = false;
          // }
        }else{
          value = input.val();
        }
        settings['sections'][count_section]['content'][count_element]['value'] = "" + value + "";
        count_element++;
      });
      count_section++;
    });

    for (var i = services.length - 1; i >= 0; i--) {
      if(services[i]['id'] == id){
        var settingsjson = JSON.stringify(settings);
        // settingsjson = settingsjson.substring(1, settingsjson.length - 1);

        var request = '{\"request\":\"SET\",\"serviceurl\":\"' + services[i]["ip"] + '\",\"settings\":' + settingsjson + '}';

        var datatosend = "q="+request.replace(/\\/g,"");
        console.log(datatosend);

        $.ajax({
          type: 'POST',
          url: 'services/communicate.php',
          data: datatosend,
          contentType: "application/x-www-form-urlencoded; charset=utf-8",
          success: function(data){
              console.log(data);
            }
        });
        break;
      }
    };
    showSettings(id);

    /*  OLD *//*
    var settings = "{"

    var service = oldsettings[id]['settings']['service'];
    if(service){
      settings += '"service":"' + service + '",';
    }
    var author = oldsettings[id]['settings']['author'];
    if(author){
      settings += '"author":"' + author + '",';
    }
    var version = oldsettings[id]['settings']['version'];
    if(version){
      settings += '"version":"' + version + '",';
    }

    settings += '"sections":['

    $(".service-settings-section").each(function() {
      settings += '{"title":"' + $(this).find("h3").html() + '",';

      settings += '"content":['

      $(".service-settings-element").each(function() {
        settings += "{";

        settings += '"title":"' + $(this).find("span").html() + '",';
        settings += "fuckin type,";
        settings += "fuckin value,";
        settings += "fuckin description";

        settings += "},";
      });
      settings = settings.substring(0,settings.length - 1);

      settings += "]},";
    });
    settings = settings.substring(0,settings.length - 1);

    settings += "]}";

    console.log(settings);
    showSettings(id);
    *//* END OLD */
  }


  services = $.map(<?php echo json_encode($services); ?>, function(el) { return el; });
</script>

</head>

<div id="serv">
  <div class="menu">
    <h1>Services</h1>
    <a href="javascript:void(0);" onClick="javascript:add(this);" class = "button normal-button">Add Service</a>
    <a href="javascript:void(0);" onClick="javascript:edit(this);" class = "button normal-button">Edit</a>
  </div>

  <div id = "addservice">
    <form method="POST" action="services/addservice.php">
      <input type="text" name = "name" placeholder="Name" />
      <input type="text" name = "ip" placeholder="IP:Port" />
      <input type='submit' class = 'saveadd button green-button' value='Save' />
    </form>
  </div>
  
  <?php
    foreach($services as $row){

      ?>
      <div class='service' id='service<?php echo $row->id; ?>'><div class='status'  id = 'c<?php echo $row->id; ?>'></div>
      <a href='javascript:void(0)' class = 'delete button red-button' onClick='javascript:deleteService(<?php echo $row->id; ?>);'>Delete</a>
      
      <div class="checkbox onoffswitch maincheckbox">
        <input type='checkbox' name='service' id = 'checkbox<?php echo $row->id; ?>' onClick='changeCheckbox(<?php echo $row->id; ?>)' />
        <div class="switch"></div>
      </div>

      <?php

     // echo "<div class=\"onoffswitch\">";
     //      echo "<input type=\"checkbox\" name=\"onoffswitch\" class=\"onoffswitch-checkbox\" id=\"checkbox" . $row->id . "\" onClick='changeCheckbox(" . $row->id . ")' />";
     //      echo "<label class=\"onoffswitch-label\" for=\"checkbox" . $row->id . "\">";
     //          echo "<span class=\"onoffswitch-inner\"></span>";
     //          echo "<span class=\"onoffswitch-switch\"></span>";
     //      echo "</label>";
     //  echo "</div>";



      // $_POST['service'] = $row->id;
      ?>
      <a href='javascript:void(0)' class = 'advanced awesome' onClick = 'javascript:showSettings(<?php echo $row->id; ?>)'></a>
      <a href='javascript:void(0)' class = 'getup button green-button save-service-settings' onClick = 'saveSettings(<?php echo $row->id; ?>)'>Save</a>
      <form method='POST' action='services/editservice.php'>

      <?php
      echo "<input type='text' class = 'editname' name = 'name' value='".$row->name."' readonly/>";
      echo "<input type='text' class = 'edit' name = 'ip' value='".$row->ip."' />";
      echo "<input type='submit' class = 'save button green-button' value='Save'/>";
      echo "<input type='text' name = 'id' value='".$row->id."' style='display:none;' />";
      echo "</form>";
      echo "<span class = 'service-error' id = 'error".$row->id."'></span>";
      echo "<div class = 'service-settings' id = 'service-settings".$row->id."'>Loading settings... Please wait</div>";
      echo "</div>";
    }
  ?>
</div>