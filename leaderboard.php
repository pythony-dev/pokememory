
<?php

    session_start();

    require_once("models/results.php");

    $results = new Results();

?>

<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="utf-8"/>
        <title> Leaderboard - PokéMemory </title>
        <link rel="stylesheet" href="index.css"/>
    </head>
    <body>
        <h1> PokéMemory </h1>
        <table>
            <tr>
                <th> # </th>
                <th> Date Time </th>
                <th> Trials </th>
                <th> Username </th>
            </tr>
            <?php foreach($results->getResults() as $id => $results) { ?>
                <tr>
                    <td> <?= $id + 1; ?> </td>
                    <td> <?= $results["created"]; ?> </td>
                    <td> <?= $results["trials"]; ?> </td>
                    <td> <?= $results["username"]; ?> </td>
                </tr>
            <?php } ?>
        </table>
        <div class="line center">
            <?php if(strval($_GET["search"] ?? "") != $_SESSION["username"]) { ?>
                <a class="width-25 other rounded-right" href="leaderboard.php?search=<?= $_SESSION["username"]; ?>"> <?= $_SESSION["username"]; ?>'s Leaderboard </a>
            <?php } else { ?>
                <a class="width-25 other rounded-right" href="leaderboard.php"> World Leaderboard </a>
            <?php } ?>
            <a class="width-25 link rounded-left" href="index.php"> Try Again </a>
        </div>
    </body>
</html>