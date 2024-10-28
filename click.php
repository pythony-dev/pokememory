<?php

    session_start();

    require_once("models/card.php");
    require_once("models/results.php");

    $cards = unserialize($_SESSION["cards"]);

    $id = intval($_GET["id"]) ?? -1;

    if($id >= 0 && $id < count($cards)) {
        $first = -1;
        $second = -1;

        foreach($cards as $key => $card) {
            if($card->getSelected()) {
                if($first == -1) $first = $key;
                else if($second == -1) $second = $key;
            }
        }

        if($first == -1 || $second == -1) $cards[$id]->select(true);
        else {
            $cards[$first]->select(false);
            $cards[$second]->select(false);   

            $_SESSION["trials"] ++;

            if($cards[$first]->getType() == $cards[$second]->getType()) {
                $cards[$first]->found();
                $cards[$second]->found();

                $success = true;

                foreach($cards as $card) {
                    if(!$card->getFounded()) $success = false;
                }

                if($success) {
                    $results = new Results();
                    $results->create();

                    header("Location: leaderboard.php");

                    exit();
                }
            }
        }
    }

    $_SESSION["cards"] = serialize($cards);

    header("Location: play.php");

?>