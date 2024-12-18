<?php

require "Database.php";
$config = require "config.php";

$db = new Database($config["database"]);
$children = $db->query("SELECT * FROM children")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Children</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Children's Letters to Santa</h1>
    </div>

    <?php
    
    foreach($children as $child) {
        $i = $child["id"];
        $lette_text = $db->query("SELECT letter_text FROM letters WHERE id = $i")->fetchColumn();

        echo "<div class='card'>";
        echo "<h2>" . $child["firstname"] . " " .$child["surname"]. " <br> Vecums:" .$child["age"] . "</h2>";
       
        $gifts = explode(":", $letter_text);
        $gifts = explode(",", $gifts[sizeof($gifts) - 1]);

        foreach ($gifts as $gift) {
            $trimmedGift = trim($gift);
            $letter_text = str_replace($trimmedGift, "<strong>$trimmedGift</strong>", $letter_text);
        }

        echo "<p>" . $letter_text . "</p>";

        echo "<p> Dāvanu saraksts: </p>";
        foreach($gifts as $gift){
            echo "<li>" . $gift . "</li>";
        }
       
        
        echo "</div><br>";
    }
    ?>

    <div class="footer">
        <p>Merry Christmas!</p>
    </div>
</body>
</html>
