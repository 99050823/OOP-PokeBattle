<!DOCTYPE html>
<html lang="en">
<?php require 'PHP/Database.php'?>
<?php require 'PHP/Connection.php'?>
<?php require 'PHP/Pokemon.php'?>
<?php require 'PHP/Generate.php'?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon</title>
    <link rel="stylesheet" href="Style/style.css">
</head>
<body>
    
    <div class="container">
        <div class="top">
            <div id="list">
                <ul>
                    <?php
                        $data = getData($conn);
                        while ($row = $data->fetch_assoc()) {
                            $name = $row['name'];
                            $id = $row['id'];
                            echo "<li><a href='PHP/View.php?id=".$id."'>".$name."</a></li>";
                        }
                    ?>
                </ul>

                <a href="PHP/Delete.php">Delete All</a><br><br>

                <form method="post">
                    <input name="add" type="submit" value="Add Pokemon">
                </form>
            </div>

            <div id="view">
                <p>Pokemon View</p>
                
                <ul>
                <?php
                    $dataArr = array();
                
                    $name = $_GET['name'];
                    $type = $_GET['type'];
                    $hp = $_GET['hp'];
                    $attack = $_GET['attack'];
                    $weakness = $_GET['weakness'];
                    $resistance = $_GET['resistance'];

                    array_push($dataArr, $name, $type, $hp, $attack, $weakness, $resistance);
                    $count = count($dataArr); 

                    for ($i=0; $i < $count; $i++) { 
                        echo "<li>".$dataArr[$i]."</li>";
                    }

                ?>
                </ul>
            </div>
        </div>

        <div class="bottom">
            <div id="active">
                <p>Active</p>
            </div>

            <div id="box">
                <p> > Battle Box</p>
            </div>
        </div>
    </div>

</body>
</html>