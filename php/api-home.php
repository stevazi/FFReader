<!doctype html>
<?php
  #start the fetch data part
  if(array_key_exists("website", $_GET)){
    $website=htmlentities($_GET["website"]);
    if(!preg_match ('/http:\/\//', $website))
      $website="http://".$website;
  }
  else
  $website="http://supporto.forumfree.it";
  $website=htmlspecialchars($_GET["website"]);
  $cl = curl_init();
  curl_setopt ($cl, CURLOPT_URL, "$website/api.php");
  curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($cl);
  curl_close($cl);
  $data = json_decode($json);
  #end the fetch data part
?>
<html>
  <head>
    <title>API-Home</title>
    <meta charset="UTF-8"> 
    <link href="skin.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php
      #start of the print page part
      #if there are some sections into the home page we will show them
      if($data->sections){
	echo "<h1>Sezioni:</h1>";
	echo "<ul id=\"section_list\">";
	foreach ($data->sections as $section){
	  echo "<li class=\"section\"><a href=\"api-section.php?website=$website&id=$section->id\"><strong>".strip_tags($section->name, "<a>")."</strong></a></li>";
	  if($section->subsections){
	    echo "<ul class=\"sub_list\">";
	    foreach ($section->subsections as $sub)
	      echo "<li class=\"section\"><a href=\"api-section.php?website=$website&id=$sub->id\">".strip_tags($sub->name, "<a>")."</a></li>";
	    echo "</ul>";
	  }
	}
	echo "</ul>";
      }
      #if there are some articles into the home page we will show them
      if($data->articles){
	echo "<h1>Articoli:</h1>";
	echo "<ul id=\"article_list\">";
	foreach ($data->articles as $art){
	  echo "<li class=\"article\"><a href=\"api-topic.php?website=$website&id=$art->id\">".strip_tags($art->title, "<a>")."</a>";
	  echo " <em>".strip_tags($art->desc, "<a>")."</em>";
	  echo "</li>";
	}
	echo "</ul>";
      }
      #end of the print page part
     ?>
  </body>
</html>
