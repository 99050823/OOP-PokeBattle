<?php
// $name, $type, $hp, $attack, $weak, $res
session_start();

echo "<h3>Battle Started</h3>";

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
        const pokemonSpan = document.querySelectorAll('.pokemon-active');
        const viewPanel = document.getElementById('view');
        const listPanel = document.getElementById('list');
        const battlePanel = document.getElementById('battle');

        var pokemonBadge1 = pokemonSpan[0];
        var pokemonBadge2 = pokemonSpan[1]; 
        var txt = "";

        viewPanel.style.display = 'none';
        listPanel.style.display = 'none';
        battlePanel.style.backgroundColor = '#00008B';
        battlePanel.style.marginLeft = '200px';
        battlePanel.style.marginRight = '200px';
        battlePanel.style.borderRadius = '20px';

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
                    pokemonBadge2.style.backgroundColor = 'red';

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
                    pokemonBadge1.style.backgroundColor = 'red';

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
            window.location.reload();
        }

        function end () {
            window.location.replace("http://localhost/OOP/Poke%20Battle%20-%20Project/OOP-PokeBattle/PHP/DestroySession.php");
        }
    } 

</script>




