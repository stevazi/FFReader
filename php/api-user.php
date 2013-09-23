<!doctype html>
<?php
    if(array_key_exists ("website", $_GET))
        $website=htmlentities($_GET["website"]);
    else
        $website="http://supporto.forumfree.it";
    if(array_key_exists ("id", $_GET))
        $id=$_GET["id"];
    else
        $id=1;
    $cl = curl_init();
    curl_setopt ($cl, CURLOPT_URL, "$website/api.php?mid=$id");
    curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($cl);
    curl_close($cl);
    $data = json_decode($json);
?>
<html>
    <head>
        <meta charset="UTF-8"> 
        <title>API-User</title>
    </head>
    <body>
        <?php
            echo "<a href=\"api-home.php?website=$website\"><h2>home</h2></a>";
            #a quick navigation url to the homepage
            $mid="m".$id;
            $user=$data->$mid;
            echo "<div>";
            echo "<h2>$user->nickname</h2>";
            echo "<img src=\"$user->avatar\" /> <br />";
            echo "<a href=\"api-group.php?website=$website&id=";
            echo $user->group->id."\"><strong>Gruppo: ".$user->group->name."</strong></a><br />";
            echo "<strong>Messaggi: $user->messages</strong><br />";
            echo "<strong>Reputazione: $user->reputation</strong><br />";
            echo "</div>";
        ?>
    </body>
</html>
