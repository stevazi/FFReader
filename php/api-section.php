<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"> 
    <title>API-Section</title>
  </head>
  <body>
    <?php
      #start the fetch data part
      $website=htmlentities($_GET["website"]);
      $id=$_GET["id"];
      if (array_key_exists("page", $_GET))
	$page=$_GET["page"];
      else
	$page=0;
      $json = file_get_contents("$website/api.php?f=$id&st=$page");
      $data = json_decode($json);
      #end the fetch data part
      echo "<h1>".$data->info->name."</h1>";
      echo "<a href=\"api-home.php?website=$website\"><h2>home</h2></a>";
      #quick navigation url to the homepage
      if($data->subsections){
	echo "<h2>Sottosezioni:</h2>";
	echo "<ul>";
	foreach ($data->subsections as $sub)
	  echo "<li><a href=\"api-section.php/?website=$website&id=$sub->id\"><strong>$sub->name</strong></a></li>";
	#every subsection has this layout
	  #li (link_to_the_subsections (name_of_the_subsections))
	echo "</ul>";
      }
      if($data->threads){
	echo "<h2>Thread:</h2>";
	echo "<ul>";
	foreach ($data->threads as $thread)
	  echo "<li><a href=\"api-topic.php/?website=$website&id=$thread->id\">$thread->title</a></li>";
	#every thread has this layout
	  #li (link_to_the_thread (name_of_the_thread))
	echo "</ul>";
	if($data->info->pages > 1){
	  echo "<a href=\"api-section.php?website=$website&id=$id\"><strong>Prima Pagina</strong></a> - ";
	  if ($page/15 > 0)
	    echo "<a href=\"api-section.php?website=$website&id=$id&page=".($page-15)."\"><strong>Pagina precedente</strong></a> - ";
	  if ($page/15 < $data->info->pages-1)
	    echo "<a href=\"api-section.php?website=$website&id=$id&page=".($page+15)."\"><strong>Pagina successiva</strong></a> - ";
	  echo "<a href=\"api-section.php?website=$website&id=$id&page=".(($data->info->pages-1) * 15)."\"><strong>Ultima Pagina</strong></a>";
	}
      }
     ?>
  </body>
</html>