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
    $cl = curl_init();
    if(array_key_exists ("num", $_GET))
        $num=$_GET["num"];
    else
        $num=15;
    curl_setopt ($cl, CURLOPT_URL, "$website/api.php?a&n=$num");
    curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($cl);
    curl_close($cl);
    $data = json_decode($json);
    #end the fetch data part
?>
<html>
    <head>
        <title>API-Last</title>
        <meta charset="UTF-8">
        <link href="skin.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
            echo "<h1>Ultimi Messaggi</h1>";
            echo "<ul>";
            foreach ($data->threads as $thread){
                echo "<li><a href=\"api-topic.php?website=$website&id=";
                echo "$thread->id\">".strip_tags($thread->title, "<a>")."</a></li>";
            }
            echo "</ul>";
        ?>
    </body>
</html>
