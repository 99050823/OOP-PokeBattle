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

    $pokemon = new Pokemon($name, $type, $attack, $weak, $res); 
    array_push($contenders, $pokemon);
}

if (!isset($_SESSION['hpPokemon1'])) {
    $_SESSION['hpPokemon1'] = 100;
    $_SESSION['hpPokemon2'] = 100;   
} 

echo "<span class='pokemon-active'><p>".$contenders[0]->getName()."</p></span>";
echo "<span><p>VS</p></span>";
echo "<span class='pokemon-active'><p>".$contenders[1]->getName()."</p></span>";

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
        
        //Function that handles the first contenders attack 
        function stage1 () {
            <?php
                $damage = $contenders[0]->getDamage($contenders[1]);
                $currentHp = $_SESSION['hpPokemon2'];

                $newHp = $currentHp - $damage;
                $_SESSION['hpPokemon2'] = $newHp;
            ?>

            txt = "<?php echo $contenders[0]->getName() . ' uses ' . $contenders[0]->getAttack()?>";
            textEl.innerHTML = txt;

            setTimeout(() => {
                txt = "<?php echo $contenders[1]->getName() . ' has ' . $_SESSION['hpPokemon2'] . ' HP left'?>";
                textEl.innerHTML = txt;                
            }, 2000);

            setTimeout(() => {
                checkHp('Pokemon2');
            }, 2000);
        }

        //Function that handles the second contenders attack
        function stage2 () {
            <?php
                $damage = $contenders[1]->getDamage($contenders[0]);
                $currentHp = $_SESSION['hpPokemon1'];

                $newHp = $currentHp - $damage;
                $_SESSION['hpPokemon1'] = $newHp;
            ?>

            txt = "<?php echo $contenders[1]->getName() . ' uses ' . $contenders[1]->getAttack()?>";
            textEl.innerHTML = txt;

            setTimeout(() => {
                txt = "<?php echo $contenders[0]->getName() . ' has ' . $_SESSION['hpPokemon1'] . ' HP left'?>";
                textEl.innerHTML = txt;                
            }, 2000);

            setTimeout(() => {
                checkHp('Pokemon1');
            }, 2000);
        }

        //Function that check the hp from each contender
        function checkHp(pokemon) {
            <?php 
                $hp1 = $_SESSION['hpPokemon1']; 
                $hp2 = $_SESSION['hpPokemon2'];   
            ?>

            var hp1 = "<?php echo $hp1?>"
            var hp2 = "<?php echo $hp2?>"

            if (pokemon == "Pokemon2") {
                if (hp2 <= 0) {
                    txt = "<?php echo $contenders[1]->getName() . " Fainted"?>"  
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
                    txt = "<?php echo $contenders[0]->getName() . " Fainted"?>"
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
            txt = "Please refresh this page to continue";
            textEl.innerHTML = txt; 
            anchor.style.display = 'inline';
        }

        //Sends the user back to the main page
        function end () {
            window.location.replace("http://localhost/OOP/Poke%20Battle%20-%20Project/OOP-PokeBattle/PHP/DestroySession.php");
        }

    } 

</script>




