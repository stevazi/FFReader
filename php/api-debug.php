<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"> 
    <title>API Debug</title>
  </head>
  <body>
    <pre>
    <?php
      $website=htmlspecialchars($_GET["website"]);
      $cl = curl_init();
      curl_setopt ($cl, CURLOPT_URL, "$website");
      curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
      $json = curl_exec($cl);
      curl_close($cl);
      $data = json_decode($json);
      print_r($data);
      echo json_last_error_msg();
     ?>
     </pre>
  </body>
</html>
