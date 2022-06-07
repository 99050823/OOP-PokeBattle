<?php
    $namesArr = array();
    $data = getData($conn, 'pokemon');
    while ($row = $data->fetch_assoc()) {
        $element = $row['name'];
        array_push($namesArr, $element);
    }

    $name = 'Charmeleon(Default)';
    $type = 'Fire';
    $attack = 'Ember';
    $weak = 'Water';
    $res = 'Electric';
    $default = new Charmeleon($name, $type, $attack, $weak, $res);
    
    if (!in_array('Charmeleon(Default)', $namesArr)) {
        sendData($conn,$name,$type,$attack,$weak,$res);
    }
?>