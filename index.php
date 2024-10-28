
<?php

    session_start();

    require_once("models/card.php");

?>

<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="utf-8"/>
        <title> Index - PokéMemory </title>
        <link rel="stylesheet" href="index.css"/>
    </head>
    <body>
        <h1> PokéMemory </h1>
        <form action="start.php" method="post">
            <div class="line">
                <label class="width-25" for="username"> Enter an Username </label>
                <input id="username" class="width-25" type="text" name="username" value="<?= $_SESSION["username"] ?? ""; ?>" placeholder="Username (Pikachu)"/>
            </div>
            <div class="line">
                <label class="width-25" for="level"> Enter an Level </label>
                <input id="level" class="width-25" type="number" name="level" value="<?= $_SESSION["level"] ?? 4; ?>" placeholder="Level (4 - <?= count(Card::getTypes()); ?>)" min="4" max="<?= count(Card::getTypes()); ?>"/>
            </div>
            <div class="line">
                <input class="width-75" type="submit" value="Start"/>
            </div>
        </form>
    </body>
</html>