<html>
  <head>
    <title>API test</title>
  </head>
  <body>
    <?php
      $website=htmlentities("http://".$_GET["website"]);
      $json = file_get_contents("$website/api.php");
      $data = json_decode($json);
      foreach ($data->sections as $section){
	echo "<h1>".$section->name."</h1>";
	echo "<a href=\"$website/?t=".$section->lastTopic->topic->id."#lastpost\"><h2>L'ultimo messaggio è di ".$section->lastTopic->poster->name." in ".$section->lastTopic->topic->name."</h2></a>";
	echo "<h1>Sotto Sezioni:</h1>";
	echo "<ul>";
	foreach ($section->subsections as $sub){
	  echo "<li><a href=\"$website/?f=$sub->id\"><h2>$sub->name</h2></a></li>";
	}
      }
      echo "</ul>";
      echo "<h1>Articoli:</h1>";
      echo "<ul>";
      foreach ($data->articles as $art){
	  echo "<li><a href=\"$website/?t=$art->id\"><strong>$art->title</strong></a>";
	  echo " <em>$art->desc</em>";
	  echo "</li>";
	}
      echo "</ul>";
     ?>
  </body>
</html>