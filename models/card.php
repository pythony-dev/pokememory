<?php

    class Card {
    
        protected $type;
        protected $isSelected;
        protected $isFounded;

        protected static $types = array("bug", "dark", "dragon", "electric", "fighting", "fire", "flying", "ghost");

        public function __construct($type) {
            $type = strval($type);

            if(in_array($type, self::$types)) $this->type = $type;

            $this->isSelected = false;
            $this->isFounded = false;            
        }

        public function getType() {
            return $this->type;
        }

        public function getSelected() {
            return $this->isSelected;
        }

        public function select($isSelected) {
            $this->isSelected = boolval($isSelected);
        }

        public function getFounded() {
            return $this->isFounded;
        }

        public function found() {
            $this->isFounded = true;
        }

        public static function getTypes() {
            return self::$types;
        }

    }

?>