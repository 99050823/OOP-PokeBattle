<?php 
include './Connection.php';
include './Database.php';

$type = $_GET['type'];
$id = $_GET['id'];
$yes = $_POST['confirmYes'];
$no = $_POST['confirmNo'];

echo "<form method='post'>
    <input name='confirmYes' type='submit' value='Yes'>
    <input name='confirmNo' type='submit' value='No'>
</form>";

if ($type == 'all') {
    echo "Do you want to delete all records?";

    if ($yes) {
        deleteAll($conn, $type);
        header("Location: ../index.php");
    } else if($no){
        header("Location: ../index.php");
    }   
} else if($type == 'active') {
    echo "Do you want to reset the active pokemon?";

    if ($yes) {
        deleteAll($conn, $type);
        header("Location: ../index.php");
    } else if($no){
        header("Location: ../index.php");
    }   
} else {
    echo "Do you want to delete this record?";

    if ($yes) {
        deleteSingle($conn, $id);
        header("Location: ../index.php");
    } else if($no){
        header("Location: ../index.php");
    } 
}

