<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"> 
    <title>API-User</title>
  </head>
  <body>
    <?php
      $website=htmlentities($_GET["website"]);
      $id=$_GET["id"];
      $json = file_get_contents("$website/api.php?mid=$id");
      $data = json_decode($json);
      echo "<a href=\"api-home.php?website=$website\"><h2>home</h2></a>";
      #a quick navigation url to the homepage
      $mid="m".$id;
      $user=$data->$mid;
      echo "<div>";
      echo "<h2>$user->nickname</h2>";
      echo "<img src=\"$user->avatar\" /> <br />";
      echo "<strong>Gruppo: ".$user->group->name."</strong><br />";
      echo "<strong>Messaggi: $user->messages</strong><br />";
      echo "<strong>Reputazione: $user->reputation</strong><br />";
      echo "</div>";
     ?>
  </body>
</html>