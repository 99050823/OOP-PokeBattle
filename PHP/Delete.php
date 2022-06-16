<?php 
error_reporting(0);
include './Connection.php';
include './Database.php';

$type = $_GET['type'];
$id = $_GET['id'];
$name = $_GET['name'];
$yes = $_POST['confirmYes'];
$no = $_POST['confirmNo'];
$refresh = $_POST['return'];

function generateForm ($type) {
    if ($type == 'default') {
        echo "<form method='post'>
            <input name='return' type='submit' value='Return'>
        </form>";
    } else {
        echo "<form method='post'>
            <input name='confirmYes' type='submit' value='Yes'>
            <input name='confirmNo' type='submit' value='No'>
        </form>";
    }
}

if ($type == 'all') {
    generateForm(null);
    echo "Do you want to delete all records?";

    if ($yes) {
        deleteAll($conn, $type);
        header("Location: ../index.php");
    } else if($no){
        header("Location: ../index.php");
    }   
} else if($type == 'active') {
    generateForm(null);
    echo "Do you want to reset the active pokemon?";

    if ($yes) {
        deleteAll($conn, $type);
        header("Location: ../index.php");
    } else if($no){
        header("Location: ../index.php");
    }   
} else if ($name == 'Charmeleon(Default)') {
    generateForm('default');
    echo "This is a default pokemon you cant delete this.";

    if ($refresh) {
        header("Location: ../index.php");
    }
} else {
    generateForm(null);
    echo "Do you want to delete this record?";

    if ($yes) {
        deleteSingle($conn, $id);
        header("Location: ../index.php");
    } else if($no){
        header("Location: ../index.php");
    } 
}

