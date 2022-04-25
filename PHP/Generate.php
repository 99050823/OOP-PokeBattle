<?php
// Pokemon Class = name - type - hp - attack - weak - res
$addButton = $_POST['add'];
$dataArr = array();
$randomType = "name";

function random ($type, $conn) {
    if ($type == "name") {
        $result = getRandomName($conn, $type);
        echo $result;
    } else if ($type == "type"){
        $result = getRandomType($conn, $type);
    }

    return $result;
}

if ($addButton && $addButton != "") {
    for ($i=0; $i < 4; $i++) { 
        $data = random($randomType, $conn);
        array_push($dataArr, $data);

        $randomType = "type";
    }
    $pokemon = new Pokemon($dataArr[0], $dataArr[1], "100", "Ember", $dataArr[2], $dataArr[3]);
    
    $name = $pokemon->name;
    $type = $pokemon->type;
    $hp = $pokemon->hp;
    $attack = $pokemon->attack;
    $weak = $pokemon->weak;
    $res = $pokemon->res;

    sendData($conn,$name,$type,$hp,$attack,$weak,$res);
    header("Location: index.php", true, 303);
}


