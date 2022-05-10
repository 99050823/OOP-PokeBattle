<?php 

class Pokemon {
    public function __construct ($name, $type, $hp, $attack, $weak, $res) {
        $this->name = $name;
        $this->type = $type;
        $this->hp = $hp;
        $this->attack = $attack;
        $this->weak = $weak;
        $this->res = $res;
    }

    public function __toString () {
        return json_encode($this);
    }

    public function attack ($target) {
        if ($this->attack == "Ember") {
            $damage = 40;
        }

        $total = $target->hp - $damage;

        return $total;
    }
}