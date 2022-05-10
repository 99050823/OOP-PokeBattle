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
    
    $name = $dataArr[0];
    $type = $dataArr[1];
    $hp = "100";
    $attack = "Ember";
    $weak = $dataArr[2];
    $res = $dataArr[3];

    sendData($conn,$name,$type,$hp,$attack,$weak,$res);
    header("Location: index.php", true, 303);
}


