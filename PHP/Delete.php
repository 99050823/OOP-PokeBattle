<?php 
include './Connection.php';
include './Database.php';

$yes = $_POST['confirmYes'];
$no = $_POST['confirmNo'];

if ($yes) {
    deleteAll($conn);
    echo "DELETED";
    header("Location: ../index.php");
} else if($no){
    header("Location: ../index.php");
}

echo "Do you want to delete all records?";

echo "<form method='post'>
    <input name='confirmYes' type='submit' value='Yes'>
    <input name='confirmNo' type='submit' value='No'>
</form>";
