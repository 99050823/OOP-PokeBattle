<?php
// Pokemon Class = name - type - attack - weak - res
// echo $typesArr[9][0];

$addButton = $_POST['add'];
$typesArr = getAllTypes($conn);
$count = count($typesArr);
$selectedTypes = array();

function getRandomType ($arrCount, $arr) {
    $int = rand(0, $arrCount);
    $element = $arr[$int][0];
    return $element;
}

function checkTypes ($arr) {
    $arr = array_unique($arr);
    $newCount = count($arr);

    while ($newCount !== 3) {
        $newType = getRandomType($count, $arr);
        array_push($arr, $newType);
        $newCount = count($arr);
    }

    return $arr;
}

if ($addButton) {
    for ($i=0; $i < 3; $i++) { 
        $newType = getRandomType($count, $typesArr);
        array_push($selectedTypes, $newType);
    }

    $selectedTypes = checkTypes($selectedTypes);
    
    $name = getRandomName($conn);
    $type = $selectedTypes[0];
    $attack = "test";
    $weak = $selectedTypes[1];
    $res = $selectedTypes[2];
    $hitpoints = 0;

    sendData($conn,$name,$type,$attack,$weak,$res,$hitpoints);
    header("Location: index.php", true, 303);
}

