<?php

class Pokemon {
    private $hp;
    private $name;
    private $type;
    private $attack;
    private $weak;
    private $res;

    public function __construct ($hp, $name, $type, $attack, $weak, $res) {
        $this->hp = $hp;
        $this->name = $name;
        $this->type = $type;
        $this->attack = $attack;
        $this->weak = $weak;
        $this->res = $res;
    }

    public function __toString () {
        return json_encode($this);
    }

    public function attack ($target) {
        $str = $this->moves();
        $int = (int)$str;
        $damage = $this->checkTyping($int, $target->weak, $target->res);

        return $damage;
    }

    public function checkTyping ($int, $weakness, $resistance) {
        $type = $this->type;
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

    public function moves () {
        $moveArray = array("Tackle"=>"10", "Vine Whip"=>"20", "Water Gun"=>"30",
        "Thunderstorm"=>"40", "Ember"=>"50");

        $move = $this->getter('attack');

        foreach($moveArray as $x => $x_value) {
            if ($x == $move) {
                return $x_value;
            }
        }
    }

    public function getDamage ($target) {
        $damage = $this->attack($target);
        return $damage;
    }

    public function setter ($typeOfGetter, $value) {
        switch ($typeOfGetter) {
            case 'hp':
                $this->hp = $value;
                break;
            case 'name':
                $this->name = $value;
            default:
                break;
        }
    }

    public function getter ($typeOfGetter) {
        switch ($typeOfGetter) {
            case 'name':
                return $this->name;
                break;
            case 'attack':
                return $this->attack;
                break;
            case 'hp':
                return $this->hp;
                break;
            default:
                break;
        }
    }
}

class Charmeleon Extends Pokemon {
}