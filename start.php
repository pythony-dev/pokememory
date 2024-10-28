<?php

    session_start();

    require_once("models/card.php");

    $cards = array();
    $types = Card::getTypes();

    shuffle($types);

    $level = $_POST["level"] ?? 4;

    if($level < 4 || $level > count(Card::getTypes())) $level = 4;

    foreach(array_slice($types, 0, $level) as $type) {
        array_push($cards, new Card($type));
        array_push($cards, new Card($type));
    }

    shuffle($cards);

    $_SESSION["cards"] = serialize($cards);

    $username = $_POST["username"] ?? "Pikachu";

    if(strlen($username) >= 3 && strlen($username) <= 20) $_SESSION["username"] = $username;
    else $_SESSION["username"] = "Pikachu";

    $_SESSION["trials"] = 0;

    header("Location: play.php");

?>