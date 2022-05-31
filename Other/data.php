<?php
    $hp = $_POST['contender2HP'];
    $dmg = $_POST['damage'];

    $total = $hp - $dmg;
    echo $total;
?>