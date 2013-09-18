<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"> 
    <title>API-Group</title>
  </head>
  <body>
    <?php
      $website=htmlentities($_GET["website"]);
      $id=$_GET["id"];
      $json = file_get_contents("$website/api.php?g=$id");
      $data = json_decode($json);
      echo "<a href=\"api-home.php?website=$website\"><h2>home</h2></a>";
      #a quick navigation url to the homepage
      #if $id is a number, then we have to show the information about the group
      if(is_numeric($id)){
	$gid="g".$id;
	$ginfo=$data->$gid->info;
	echo "<div>";
	echo "<h1>".$ginfo->name."</h1>";
	echo "<img src=\"".$ginfo->image."\" />";
	echo "<em>".$ginfo->desc."</em>";
	echo "</div>";
      }
      #if $id isn't a number, we just print the name of the required type of user (eg: members, admin)
	#and properly initalize $gid so we can reuse the print members part
      else{
	echo "<h1>$id</h1>";
	$gid=$id;
      }
      #print members part
      if($data->$gid->users){
	echo "<h2>Membri:</h2>";
	echo "<ul>";
	foreach($data->$gid->users as $user)
	  echo "<li><a href=\"api-user.php?website=$website&id=$user\">$user</a></li>";
	echo "</ul>";
      }
     ?>
  </body>
</html>