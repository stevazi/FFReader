<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"> 
    <title>API-User</title>
  </head>
  <body>
    <?php
      $website=htmlentities("http://".$_GET["website"]);
      $id=$_GET["id"];
      $json = file_get_contents("$website/api.php?mid=$id");
      $data = json_decode($json);
     ?>
  </body>
</html>