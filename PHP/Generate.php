<?php
// Pokemon Class = name - type - hp - attack - weak - res
$addButton = $_POST['add'];
$pokeArr = array();

if ($addButton) {
    $pokemon = new Pokemon("Name", "Type", "HP", "attack", "weak", "res");
    array_push($pokeArr, $pokemon);
    $listElements = generate();
}

function generate () {
    $listElements = "<li>test</li>";
    return $listElements;
}


