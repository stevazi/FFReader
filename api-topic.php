<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"> 
    <title>API-Topic</title>
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
      $json = file_get_contents("$website/api.php?t=$id&st=$page");
      $data = json_decode($json);
      #end the fetch data part
      echo "<h1>".$data->info->title."</h1>";
      #the title of the topic
      echo "<a href=\"api-section.php?website=$website&id=".$data->info->section_id."\"><h2>".$data->info->section_name."</h2></a>";
      #a quick navigation url to the section
      echo "<a href=\"api-home.php?website=$website\"><h2>home</h2></a>";
      #a quick navigation url to the homepage
      echo "<h1>Messaggi:</h1>";
      echo "<ol>";
      #post are printed using an ordinated list
      foreach ($data->messages as $msg){
	echo "<li>";
	echo "<span><a href=\"api-user.php?website=$website&id=".$msg->user->id."\">".$msg->user->name."</a></span>";
	echo "<div>".$msg->content."</div></li>";
	#every post has this layout:
	  #li (span (author) div (content))
	  #maybe in the future I will add other informations, but for now they are sufficient
      }
      echo "</ol>";
      if($data->info->pages > 1){
	echo "<a href=\"api-topic.php?website=$website&id=$id\"><strong>Prima Pagina</strong></a> - ";
	if ($page/15 > 0)
	  echo "<a href=\"api-topic.php?website=$website&id=$id&page=".($page-15)."\"><strong>Pagina precedente</strong></a> - ";
	if ($page/15 < $data->info->pages-1)
	  echo "<a href=\"api-topic.php?website=$website&id=$id&page=".($page+15)."\"><strong>Pagina successiva</strong></a> - ";
	echo "<a href=\"api-topic.php?website=$website&id=$id&page=".(($data->info->pages-1) * 15)."\"><strong>Ultima Pagina</strong></a>";
      }
     ?>
  </body>
</html>