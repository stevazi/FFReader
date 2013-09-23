<!doctype html>
<?php
    #start the fetch data part
    if(array_key_exists("website", $_GET))
        $website=htmlentities($_GET["website"]);
    else
        $website="http://supporto.forumfree.it";
    if(array_key_exists("id", $_GET))
        $id=$_GET["id"];
    else
        $id=194;
    if (array_key_exists("page", $_GET))
        $page=$_GET["page"];
    else
        $page=0;
    $cl = curl_init();
    curl_setopt ($cl, CURLOPT_URL, "$website/api.php?f=$id&st=$page");
    curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($cl);
    curl_close($cl);
    $data = json_decode($json);
    #end the fetch data part
?>
<html>
    <head> 
        <title>API-Section</title>
        <meta charset="UTF-8">
        <link href="skin.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
            echo "<h1>".strip_tags($data->info->name, "<a>")."</h1>";
            echo "<a href=\"api-home.php?website=$website\"><strong>home</strong></a> ";
            if($data->info->subsection_mother_id){
                echo "<a href=\"api-home.php?website=$website&id=";
                echo $data->info->subsection_mother_id;
                echo "\"><strong>Torna a ".$data->info->subsection_mother_name."</strong></a>";
                #quick navigation url to the homepage
            }
            if($data->subsections){
                echo "<h2>Sottosezioni:</h2>";
                echo "<ul id=\"section_list\">";
                foreach ($data->subsections as $sub){
                    echo "<li class=\"section\"><a href=\"api-section.php/?website=$website&id=$sub->id\"><strong>";
                    echo strip_tags($sub->name, "<a>")."</strong></a></li>";
                }
                #every subsection has this layout
                    # li.section (link_to_the_subsections (name_of_the_subsections))
                echo "</ul>";
            }
            if($data->threads){
                echo "<h2>Thread:</h2>";
                echo "<ul id=\"thread_list\">";
                foreach ($data->threads as $thread){
                    echo "<li class=\"thread\"><a href=\"api-topic.php/?website=$website&id=$thread->id\">";
                    echo strip_tags($thread->title, "<a>")."</a></li>";
                }
                #every thread has this layout
                    # li.thread (link_to_the_thread (name_of_the_thread))
                echo "</ul>";
                if($data->info->pages > 1){
                    echo "<div id=\"nav_footer\">";
                    if($page > 0){
                        echo "<a href=\"api-section.php?website=$website&id=$id\"><strong>Prima Pagina</strong></a> ";
                        echo "<a href=\"api-section.php?website=$website&id=$id&page=".($page-15)."\"><strong>Pagina precedente</strong></a> ";
                    }
                    if ($page/15 < $data->info->pages-1){
                        echo "<a href=\"api-section.php?website=$website&id=$id&page=".($page+15)."\"><strong>Pagina successiva</strong></a> ";
                        echo "<a href=\"api-section.php?website=$website&id=$id&page=";
                        echo (($data->info->pages-1) * 15)."\"><strong>Ultima Pagina</strong></a>";
                    }
                    echo "</div>";
                }
            }
        ?>
    </body>
</html>
