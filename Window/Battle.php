<?php
// $name, $type, $hp, $attack, $weak, $res
echo "<h3>Battle Started</h3>";

$contenders = array();
$active = getData($conn, 'active');

while($row = mysqli_fetch_assoc($active)) {
    $data = getDataById($conn, $row['id']);

    $name = $data->name;
    $type = $data->type;
    $hp = $data->hp;
    $attack = $data->attack;
    $weak = $data->weakness;
    $res = $data->resistance;

    $pokemon = new Pokemon($name, $type, $hp, $attack, $weak, $res); 
    array_push($contenders, $pokemon);
}

echo "<span class='pokemon-active'><p>".$contenders[0]->name."</p></span>";
echo "<span><p>VS</p></span>";
echo "<span class='pokemon-active'><p>".$contenders[1]->name."</p></span>";

echo "<h2></h2>";

?>

<script>
    window.onload = function(e) {
        const textEl = document.querySelector('h2');
        var txt = "";
        textEl.innerHTML = txt;

        stage1();
        
        function stage1 () {
            var hp = "<?php echo $contenders[0]->attack($contenders[1])?>"
            
            setTimeout(function () {
                txt = "<?php echo $contenders[1]->name . " takes 40 hitpoints damage "?>";
                textEl.innerHTML = txt;
            }, 2000)

            if (hp > 0) {
                txt = "<?php echo $contenders[0]->name . " uses " . $contenders[0]->attack?>"
                textEl.innerHTML = txt;
                setTimeout(stage2, 4000);
            } else {
                txt = "<?php echo $contenders[1]->name . " fainted " ?>"
                textEl.innerHTML = txt;
            }
        }

        function stage2 () {
            var hp = "<?php echo $contenders[1]->attack($contenders[0])?>"
            
            setTimeout(function () {
                txt = "<?php echo $contenders[0]->name . " takes 40 hitpoints of damage "?>";
                textEl.innerHTML = txt;
            }, 2000)

            if (hp > 0) {
                txt = "<?php echo $contenders[1]->name . " uses " . $contenders[1]->attack?>"
                textEl.innerHTML = txt;
                setTimeout(stage1, 4000);
            } else {
                txt = "<?php echo $contenders[0]->name . " fainted " ?>"
                textEl.innerHTML = txt;
            }
        }
    } 
</script>



