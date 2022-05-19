<?php 
include 'Connection.php';
include 'Database.php';

$id = $_GET['id'];
$data = getDataById($conn, $id);

header("Location: http://localhost/OOP/Poke%20Battle%20-%20Project/OOP-PokeBattle?id=$data->id&name=$data->name&type=$data->type&hp=$data->hp&attack=$data->attack&weakness=$data->weakness&resistance=$data->resistance&view-check=TRUE");
