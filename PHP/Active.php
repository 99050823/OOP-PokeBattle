<?php 
include 'Connection.php';
include 'Database.php';

$data = checkCount($conn);
$count = $data['total'];

if ($count >= 0 && $count < 2) {
    $id = $_GET['id'];
    $data = getDataById($conn, $id);
    $name = $data->name;

    sendActiveData($conn, $id, $name);
    header("Location: http://localhost/OOP/Poke%20Battle%20-%20Project/OOP-PokeBattle");
} else {
    header("Location: http://localhost/OOP/Poke%20Battle%20-%20Project/OOP-PokeBattle");
}
