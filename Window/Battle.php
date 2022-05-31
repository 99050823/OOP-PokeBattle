<?php
// $name, $type, $hp, $attack, $weak, $res

echo "<h3>Battle Started</h3>";

$contenders = array();
$active = getData($conn, 'active');

while($row = mysqli_fetch_assoc($active)) {
    $data = getDataById($conn, $row['id']);

    $hp = 100;
    $name = $data->name;
    $type = $data->type;
    $attack = $data->attack;
    $weak = $data->weakness;
    $res = $data->resistance;

    $pokemon = new Pokemon($hp, $name, $type, $attack, $weak, $res); 
    array_push($contenders, $pokemon);
}

echo "<span class='pokemon-active'><p>".$contenders[0]->getter('name')."</p></span>";
echo "<span><p>VS</p></span>";
echo "<span class='pokemon-active'><p>".$contenders[1]->getter('name')."</p></span>";

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
            txt = "<?php echo $contenders[0]->getter('name') . ' uses ' . $contenders[0]->getter('attack')?>";
            textEl.innerHTML = txt;

            setTimeout(() => {
                $.ajax({
                    type: 'post',
                    url: './Other/data.php',
                    data: {
                        contender2HP: '<?php echo $contenders[1]->getter('hp')?>',
                        damage: '<?php echo $contenders[0]->getDamage($contenders[1])?>'
                    },
                    success: function(data) {
                        data = parseInt(data);
                        txt = `<?php echo $contenders[1]->getter('name')?> has ${data} HP left`;
                        textEl.innerHTML = txt;
                    }
                })
            }, 2000);
        }

        function stage2 () {

        }

        function checkHp(pokemon) {
            <?php 
                $hp1 = $contenders[0]->getter('hp'); 
                $hp2 = $contenders[1]->getter('hp');   
            ?>

            var hp1 = "<?php echo $hp1?>"
            var hp2 = "<?php echo $hp2?>"

            if (pokemon == "Pokemon2") {
                if (hp2 <= 0) {
                    txt = "<?php echo $contenders[1]->getter('name') . " Fainted"?>"  
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
                    txt = "<?php echo $contenders[0]->getter('name') . " Fainted"?>"
                    pokemonBadge1.style.backgroundColor = 'red';

                    setTimeout(() => {
                        end();  
                    }, 3000);
                } else {
                    setTimeout(() => {
                        stage1();
                    }, 2000);
                }
            }

            textEl.innerHTML = txt;
        }

        function end () {
            window.location.replace("http://localhost/OOP/Poke%20Battle%20-%20Project/OOP-PokeBattle/");
        }

    } 

</script>




