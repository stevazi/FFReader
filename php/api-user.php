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
        <title>API-User</title>
        <meta charset="UTF-8">
        <link href="skin.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
            echo "<a href=\"api-home.php?website=$website\"><strong>home</strong></a>";
            #a quick navigation url to the homepage
            $mid="m".$id;
            $user=$data->$mid;
            echo "<div id=\"user_data\">";
            echo "<h2 id=\"nickname\">$user->nickname</h2>";
            echo "<div id=\"user_avatar\">";
            echo "<img src=\"$user->avatar\" id=\"avatar\" />";
            echo "</div>";
            echo "<div id=\"user_info\">";
            echo "<a href=\"api-group.php?website=$website&id=";
            echo $user->group->id."\"><strong id=\"user_group\">Gruppo: ".$user->group->name."</strong></a><br />";
            echo "<strong id=\"user_messages\">Messaggi: $user->messages</strong><br />";
            echo "<strong id=\"user_rep\">Reputazione: $user->reputation</strong><br />";
            echo "</div>";
            echo "</div>";
        ?>
    </body>
</html>
