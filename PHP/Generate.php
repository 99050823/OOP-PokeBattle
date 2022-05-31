<?php
// Pokemon Class = name - type - attack - weak - res
// echo $typesArr[9][0];

$addButton = $_POST['add'];
$typesArr = getAllTypes($conn);
$count = count($typesArr);
$selectedTypes = array();

function getRandomInt ($count) {
    $int = rand(0, $count);
    return $int;
}

if ($addButton) {
    for ($i=0; $i < 3; $i++) { 
        $rndInt = getRandomInt($count);
        $element = $typesArr[$rndInt][0];

        while ($element == 0) {
            $rndInt = getRandomInt($count);
            $element = $typesArr[$rndInt][0];
        }

        array_push($selectedTypes, $element);
        $typesArr[$rndInt] = 0;   
    }

    $name = getRandomName($conn);
    $type = $selectedTypes[0];
    $attack = getRandomMove($conn);
    $weak = $selectedTypes[1];
    $res = $selectedTypes[2];

    sendData($conn,$name,$type,$attack,$weak,$res);
    header("Location: index.php", true, 303);
}

