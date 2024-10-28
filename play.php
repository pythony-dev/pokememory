<?php

    session_start();

    require_once("models/card.php");

    $cards = unserialize($_SESSION["cards"]);

?>

<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="utf-8"/>
        <title> Play - PokéMemory </title>
        <link rel="stylesheet" href="index.css"/>
    </head>
    <body>
        <h1> PokéMemory </h1>
        <div class="column">
            <?php for($i = 0; $i < count($cards); $i += 4) { ?>
                <div class="line">
                    <?php for($j = 0; $j < 4; $j ++) { ?>
                        <?php if($i + $j < count($cards)) { ?>
                            <a href="click.php?id=<?= $i + $j; ?>">
                                <img class="card<?= $cards[$i + $j]->getFounded() ? " found" : null; ?>" src="images/<?= $cards[$i + $j]->getSelected() || $cards[$i + $j]->getFounded() ? $cards[$i + $j]->getType() : "back" ?>.png" alt="Card <?= $i + $j; ?>"/>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="line center">
            <p class="width-25 rounded-right"> Trials : <?= intval($_SESSION["trials"]); ?> </p>
            <a class="width-25 link rounded-left" href="index.php"> Try Again </a>
        </div>
    </body>
</html>