<?php
// $name, $type, $hp, $attack, $weak, $res
session_start();

echo "<div>";
echo "<span><h3>Battle Started</h3></span>";
echo "<span id='anchor-span'><a href='./PHP/DestroySession.php'>exit</a></span>";
echo "</div>";

$contenders = array();
$active = getData($conn, 'active');

while($row = mysqli_fetch_assoc($active)) {
    $data = getDataById($conn, $row['id']);

    $name = $data->name;
    $type = $data->type;
    $attack = $data->attack;
    $weak = $data->weakness;
    $res = $data->resistance;
    $hitpoints = $data->hitpoints;

    $pokemon = new Pokemon($name, $type, $attack, $weak, $res, $hitpoints); 
    array_push($contenders, $pokemon);
}

if (!isset($_SESSION['hpPokemon1'])) {
    $_SESSION['hpPokemon1'] = 100;
    $_SESSION['hpPokemon2'] = 100;   
} 

echo "<span class='pokemon-active'><p>".$contenders[0]->name."</p></span>";
echo "<span><p>VS</p></span>";
echo "<span class='pokemon-active'><p>".$contenders[1]->name."</p></span>";

echo "<h2></h2>";

?>

<script>
    window.onload = function(e) {
        const textEl = document.querySelector('h2');
        const anchor = document.getElementById('anchor-span');
        var txt = "";
        anchor.style.display = 'none';
        stage1();
        
        function stage1 () {
            <?php 
                $hp = $contenders[0]->calculateHp($contenders[1], $_SESSION['hpPokemon2']);
                $_SESSION['hpPokemon2'] = $hp;
            ?>

            txt = "<?php echo $contenders[0]->name . " uses " . $contenders[0]->attack?>"
            textEl.innerHTML = txt;

            setTimeout(() => {
                txt = "<?php echo $contenders[1]->name . " has " . $_SESSION['hpPokemon2'] . " HP left"?>";
                textEl.innerHTML = txt;
            }, 2000);

            setTimeout(() => {
                checkHp("Pokemon2");
            }, 4000);
        }

        function stage2 () {
            <?php 
                $hp = $contenders[1]->calculateHp($contenders[0], $_SESSION['hpPokemon1']);
                $_SESSION['hpPokemon1'] = $hp;
            ?>
            
            txt = "<?php echo $contenders[1]->name . " uses " . $contenders[1]->attack?>"
            textEl.innerHTML = txt;

            setTimeout(() => {
                txt = "<?php echo $contenders[0]->name . " has " . $_SESSION['hpPokemon1'] . " HP left"?>";
                textEl.innerHTML = txt;
            }, 2000);

            setTimeout(() => {
                checkHp("Pokemon1");
            }, 4000);
        }

        function checkHp(pokemon) {
            <?php 
                $hp1 = $_SESSION['hpPokemon1']; 
                $hp2 = $_SESSION['hpPokemon2'];   
            ?>

            var hp1 = "<?php echo $hp1?>"
            var hp2 = "<?php echo $hp2?>"

            if (pokemon == "Pokemon2") {
                if (hp2 <= 0) {
                    txt = "<?php echo $contenders[1]->name . " Fainted"?>"

                    setTimeout(() => {
                        end();
                    }, 3000);
                } else {
                    setTimeout(() => {
                        stage2();
                    }, 2000);
                }
            } else if (pokemon == "Pokemon1"){
                if (hp1 <= 0) {
                    txt = "<?php echo $contenders[0]->name . " Fainted"?>"
                    
                    setTimeout(() => {
                        end();  
                    }, 3000);
                } else {
                    setTimeout(() => {
                        refresh();
                    }, 2000);
                }
            }

            textEl.innerHTML = txt;
        }

        function refresh () {
            txt = "Please refresh this page to continue";
            textEl.innerHTML = txt; 
            anchor.style.display = 'inline';
        }

        function end () {
            txt = "Please click on 'exit' to return to the home page.";
            textEl.innerHTML = txt;
            anchor.style.display = 'inline';
        }
    } 

</script>




