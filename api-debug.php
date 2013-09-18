<html>
  <head>
    <title>API Debug</title>
  </head>
  <body>
    <pre>
    <?php
      $website=htmlspecialchars($_GET["website"]);
      $json = file_get_contents("$website");
      $data = json_decode($json);
      print_r($data);
      echo json_last_error_msg();
     ?>
     </pre>
  </body>
</html>