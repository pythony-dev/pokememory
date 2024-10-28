<?php

    class Results {

        protected $database;

        public function __construct() {
            try {
                $this->database = new PDO("mysql:host=localhost;dbname=PokéMemory;charset=utf8", "root", "root");
            } catch(PDOException $error) {
                header("Location: index.php");

                exit();
            }
        }

        public function create() {
            $trials = intval($_SESSION["trials"]);
            $username = strval($_SESSION["username"]);

            if($trials <= 0) return false;
            else if(empty($username)) return false;

            $query = $this->database->prepare("INSERT INTO Results (created, level, trials, username) VALUES (NOW(), :level, :trials, :username)");
            $query->bindValue(":level", count(unserialize($_SESSION["cards"])) / 2, PDO::PARAM_INT);
            $query->bindValue(":trials", $trials, PDO::PARAM_INT);
            $query->bindValue(":username", $username, PDO::PARAM_STR);

            if($query->execute()) {
                $_SESSION["trials"] = 0;

                return true;
            } else return false;
        }

        public function getResults() {
            $query = $this->database->prepare("SELECT created, trials, username FROM Results WHERE level = :level AND username LIKE :username ORDER BY trials LIMIT 10");
            $query->bindValue(":level", count(unserialize($_SESSION["cards"])) / 2, PDO::PARAM_INT);
            $query->bindValue(":username", "%" . strval($_GET["search"] ?? "") . "%", PDO::PARAM_STR);
            $query->execute();

            return $query->fetchAll();
        }

    }

?>