<!doctype html>
<?php
    if (array_key_exists ("website", $_GET))
        $website=htmlentities($_GET["website"]);
    else
        $website="supporto.forumfree.it";
    if(array_key_exists ("id", $_GET))
        $id=$_GET["id"];
    else
        $id="members";
    $cl = curl_init();
    curl_setopt ($cl, CURLOPT_URL, "$website/api.php?g=$id");
    curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($cl);
    curl_close($cl);
    $data = json_decode($json);
?>
<html>
    <head>
        <title>API-Group</title>
        <meta charset="UTF-8">
        <link href="skin.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
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
                $cl = curl_init();
                curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
                $user_list=array_chunk($data->$gid->users, 99);
                foreach ($user_list as $users){
                    $mid = implode (",", $users);
                    curl_setopt ($cl, CURLOPT_URL, "$website/api.php?mid=$mid");
                    $tmp = curl_exec($cl);
                    $info = json_decode ($tmp);
                    for($i=0; $i< sizeof($users); $i+=1){
                        $uid="m".$users[$i];
                        echo "<li><a href=\"api-user.php?website=$website&id=$users[$i]\">".$info->$uid->nickname."</a></li>";
                    }
                }
                curl_close($cl);
                echo "</ul>";
            }
        ?>
    </body>
</html>
