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
      $website=htmlspecialchars($_GET["website"]);
      $cl = curl_init();
      curl_setopt ($cl, CURLOPT_URL, "$website/api.php?mid=$id");
      curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
      $json = curl_exec($cl);
      curl_close($cl);
      $data = json_decode($json);
      echo "<a href=\"api-home.php?website=$website\"><h2>home</h2></a>";
      #a quick navigation url to the homepage
      $mid="m".$id;
      $user=$data->$mid;
      echo "<div>";
      echo "<h2>$user->nickname</h2>";
      echo "<img src=\"$user->avatar\" /> <br />";
      echo "<a href=\"api-group.php?website=$website&id=".$user->group->id."\"><strong>Gruppo: ".$user->group->name."</strong></a><br />";
      echo "<strong>Messaggi: $user->messages</strong><br />";
      echo "<strong>Reputazione: $user->reputation</strong><br />";
      echo "</div>";
     ?>
  </body>
</html>
