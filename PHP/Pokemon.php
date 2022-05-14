<?php

class Pokemon {
    public function __construct ($name, $type, $hp, $attack, $weak, $res, $hitpoints) {
        $this->name = $name;
        $this->type = $type;
        $this->hp = $hp;
        $this->attack = $attack;
        $this->weak = $weak;
        $this->res = $res;
        $this->hitpoints = $hitpoints;
    }

    public function __toString () {
        return json_encode($this);
    }

    public function attack ($target) {
        $str = $this->moves();
        $int = (int)$str;
        $damage = $this->checkTyping($int, $target->weak, $target->res);
        $this->hitpoints = $damage;

        return $damage;
    }

    public function checkTyping ($int, $weakness, $resistance) {
        $type = $this->type;
        $newDamage = 0;

        if ($type == $weakness) {
            $newDamage = $int + 10;
        } else if ($type == $resistance) {
            $newDamage = $int - 10;
        } else {
            $newDamage = $int;
        }

        return $newDamage;
    }

    public function moves () {
        $moveArray = array("Tackle"=>"10", "Vine Whip"=>"20", "Water Gun"=>"30",
        "Thunderstorm"=>"40", "Ember"=>"50");

        $move = $this->attack;

        foreach($moveArray as $x => $x_value) {
            if ($x == $move) {
                return $x_value;
            }
        }
    }
}
