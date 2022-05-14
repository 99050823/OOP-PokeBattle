<?php
error_reporting(E_ALL);
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
    $hitpoints = $data->hitpoints;

    $pokemon = new Pokemon($name, $type, $hp, $attack, $weak, $res, $hitpoints); 
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
            var damage = "<?php echo $contenders[0]->attack($contenders[1]);?>";
            var hp = "<?php echo $contenders[1]->hp;?>";

            var newHp = hp - damage;

            txt = newHp;
            textEl.innerHTML = txt;

            <?php 
                $newDamage = $contenders[0]->attack($contenders[1]);
                $contenderHp = $contenders[1]->hp;
                
                $newHp = $contenderHp - $newDamage;
                $contenders[1]->hp = $contenderHp;
            ?>

            setTimeout(() => {
                stage1();
            }, 1000);
        }

        function stage2 () {
            var hp = "<?php echo $contenders[1]->attack($contenders[0])?>"
            <?php $contenders[1]->hp = $contenders[1]->hp - $contenders[0]->hitpoints?>

            if (hp > 0) {
                txt = "<?php echo $contenders[1]->name . " uses " . $contenders[1]->attack?>"
                textEl.innerHTML = txt;

                setTimeout(() => {
                txt = "<?php echo $contenders[0]->name . " takes " . $contenders[1]->hitpoints." hitpoints of damage "?>";
                textEl.innerHTML = txt;
                }, 1000);

                setTimeout(stage1, 2000);
            } else {
                txt = "<?php echo $contenders[0]->name . " fainted " ?>"
                textEl.innerHTML = txt;
            }
        }
    } 
</script>



