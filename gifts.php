<?php

require "Database.php";
$config = require "config.php";

$db = new Database($config["database"]);
$gifts = $db->query("SELECT * FROM gifts")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gifts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Christmas Gifts</h1>
    </div>

    <?php
    foreach($gifts as $gift) {
        echo "<div class='card'>";
        echo "<h2>" . htmlspecialchars($gift["name"]) . "</h2>";
        echo "<p>" . htmlspecialchars($gift["description"]) . "</p>";
        echo "</div><br>";
    }
    ?>

    <div class="footer">
        <p>Happy Holidays!</p>
    </div>
</body>
</html>
