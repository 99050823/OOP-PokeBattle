<?php

// The pokemon class contains all data it needs to use in the battle scene
// It handles the pokemon's weakness and resistance an also checks damage an hp
class Pokemon {
    private $name;
    private $type;
    private $attack;
    private $weak;
    private $res;

    public function __construct ($name, $type, $attack, $weak, $res) {
        $this->name = $name;
        $this->type = $type;
        $this->attack = $attack;
        $this->weak = $weak;
        $this->res = $res;
    }

    public function __toString () {
        return json_encode($this);
    }

    //Takes the attack from a pokemon and calculates a damage based on a resistance or weakness 
    public function attack ($target) {
        $str = $this->moves();
        $int = (int)$str;
        $damage = $this->checkTyping($int, $target->weak, $target->res);

        return $damage;
    }

    //Checks the type and compares it with the resistance or weakness from an opponent  
    public function checkTyping ($int, $weakness, $resistance) {
        $type = $this->getType();
        $newDamage = 0;

        if ($type == $weakness) {
            $newDamage = $int + 10;
        } else if ($type == $resistance) {
            if ($this->attack == "Tackle") {
                $newDamage = 10;
            } else {
                $newDamage = $int - 10;
            }
        } else {
            $newDamage = $int;
        }

        return $newDamage;
    }

    //Takes the attack from a pokemon and adds damage to it
    public function moves () {
        $moveArray = array("Tackle"=>"10", "Vine Whip"=>"20", "Water Gun"=>"30",
        "Thunderstorm"=>"40", "Ember"=>"50");

        $move = $this->getAttack();

        foreach($moveArray as $x => $x_value) {
            if ($x == $move) {
                return $x_value;
            }
        }
    }

    public function setName ($value) {
        $this->name = $value;
    }

    public function getDamage ($target) {
        $damage = $this->attack($target);
        return $damage;
    }

    public function getName() {
       return $this->name;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function getType() {
        return $this->type;
    }
}

class Charmeleon Extends Pokemon {
    public function __construct() {
        parent::__construct($name, $type, $attack, $weak, $res);
    }
}