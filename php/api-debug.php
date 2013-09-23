<!doctype html>
<?php
    if(array_key_exists ("website", $_GET))
        $website=htmlspecialchars($_GET["website"]);
    else
        $website="http://supporto.forumfree.it/api.php";
    $cl = curl_init();
    curl_setopt ($cl, CURLOPT_URL, "$website");
    curl_setopt ($cl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($cl);
    curl_close($cl);
    $data = json_decode($json);
?>
<html>
    <head>
        <meta charset="UTF-8"> 
        <title>API Debug</title>
    </head>
    <body>
        <pre>
            <?php
                print_r($data);
                echo json_last_error_msg();
            ?>
        </pre>
    </body>
</html>
