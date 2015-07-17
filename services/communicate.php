<?php
  $post_cont = (array) json_decode($_POST['q']);
  error_log($post_cont['serviceurl']);
  $url = 'http://'.$post_cont['serviceurl'];
  if($post_cont['request'] == 'SET'){
    $content = '{"request":"SET", "settings":'.json_encode($post_cont['settings']).'}';
  }else{
    $content = '{"request":"'.$post_cont['request'].'"}';
  }
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 100);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

  $response = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  if($status != 200){
    echo '{"response":"FAILED", "error":"'.curl_error($curl).': '.$post_cont['serviceurl'].'"}';
  }else{
    echo $response;
  }
  curl_close($curl);
?>
