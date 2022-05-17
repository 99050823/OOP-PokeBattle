<?php
// Pokemon Class = name - type - attack - weak - res
$addButton = $_POST['add'];
$dataArr = array();

function random ($type, $conn) {
    if ($type == "name") {
        $result = getRandomName($conn, $type);
        echo $result;
    } else if ($type == "type"){
        $result = getRandomType($conn, $type);
    } else if ($type == "move") {
        $result = getRandomMove($conn, $type);
    }

    return $result;
}

if ($addButton && $addButton != "") {
    for ($i=0; $i < 5; $i++) { 
        switch (true) {
            case $i == 0:
                $randomType = "name";
                break;
            case $i < 3:
                $randomType = "type";
                break;
            case $i > 3:
                $randomType = "move"; 
                break;
            default:
                break;
        }

        $data = random($randomType, $conn);
        array_push($dataArr, $data);
    }
    
    $name = $dataArr[0];
    $type = $dataArr[1];
    $attack = $dataArr[4];
    $weak = $dataArr[2];
    $res = $dataArr[3];
    $hitpoints = 0;

    sendData($conn,$name,$type,$attack,$weak,$res,$hitpoints);
    header("Location: index.php", true, 303);
}


