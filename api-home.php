<html>
  <head>
    <title>API-Home</title>
  </head>
  <body>
    <?php
      #start the fetch data part
      $website=htmlentities($_GET["website"]);
      $json = file_get_contents("$website/api.php");
      $data = json_decode($json);
      #end the fetch data part
      echo "<h1>Sezioni:</h1>";
      echo "<ul>";
      foreach ($data->sections as $section){
	  echo "<li><a href=\"api-section.php?website=$website&id=$section->id\"><h2>$section->name</h2></a></li>";
	  echo "<ul>";
	  foreach ($section->subsections as $sub){
	    echo "<li><a href=\"api-section.php?website=$website&id=$sub->id\"><h2>$sub->name</h2></a></li>";
	  }
	  echo "</ul>";
      }
      echo "</ul>";
      echo "<h1>Articoli:</h1>";
      echo "<ul>";
      foreach ($data->articles as $art){
	  echo "<li><a href=\"api-topic.php?website=$website&id=$art->id\"><strong>$art->title</strong></a>";
	  echo " <em>$art->desc</em>";
	  echo "</li>";
	}
      echo "</ul>";
     ?>
  </body>
</html>