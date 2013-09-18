<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"> 
    <title>API-Home</title>
  </head>
  <body>
    <?php
      #start the fetch data part
      $website=htmlentities($_GET["website"]);
      if(!preg_match ('/http:\/\//', $website))
	$website="http://".$website;
      $json = file_get_contents("$website/api.php");
      $data = json_decode($json);
      #end the fetch data part
      if($data->sections){
	echo "<h1>Sezioni:</h1>";
	echo "<ul>";
	foreach ($data->sections as $section){
	    echo "<li><a href=\"api-section.php?website=$website&id=$section->id\"><strong>$section->name</strong></a></li>";
	    echo "<ul>";
	    foreach ($section->subsections as $sub)
	      echo "<li><a href=\"api-section.php?website=$website&id=$sub->id\"><strong>$sub->name</strong></a></li>";
	    echo "</ul>";
	}
	echo "</ul>";
      }
      if($data->articles){
	echo "<h1>Articoli:</h1>";
	echo "<ul>";
	foreach ($data->articles as $art){
	    echo "<li><a href=\"api-topic.php?website=$website&id=$art->id\"><strong>$art->title</strong></a>";
	    echo " <em>$art->desc</em>";
	    echo "</li>";
	  }
	echo "</ul>";
      }
     ?>
  </body>
</html>