<!DOCTYPE html>
<html lang="en">
<?php error_reporting(0)?>
<?php require 'PHP/Database.php'?>
<?php require 'PHP/Connection.php'?>
<?php require 'PHP/Pokemon.php'?>
<?php require 'PHP/Generate.php'?>
<?php require 'PHP/Default.php'?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon</title>
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="container">
        <div class="top">
            <div id="list">
                <ul>
                    <?php
                        $data = getData($conn, 'pokemon');
                        while ($row = $data->fetch_assoc()) {
                            $name = $row['name'];
                            $id = $row['id'];
                            echo "<li><a href='PHP/View.php?id=".$id."'>".$name."</a></li>";
                        }
                    ?>
                </ul>

                <a href="PHP/Delete.php?type=all">Delete All</a><br><br>

                <form method="post">
                    <input name="add" type="submit" value="Add Pokemon">
                </form>
            </div>

            <div id="view">
                <?php
                    $id = $_GET['id'];
                    $name = $_GET['name'];
                    $type = $_GET['type'];
                    $attack = $_GET['attack'];
                    $weakness = $_GET['weakness'];
                    $resistance = $_GET['resistance'];
                ?>

                <span><p>Pokemon View</p></span>
                <span id="icon-span">
                    <a href="PHP/Delete.php?type=single&id=<?php echo $id?>&name=<?php echo $name?>"><i class="fa-solid fa-delete-left"></i></a>
                </span><br> 

                <a id="setActive" href="PHP/Active.php?id=<?php echo $id?>">Set active</a>
                
                <ul>
                <?php
                    $dataArr = array();
                    $textArr = array("Name", "Type", "Move", "Weakness", "Resistance");
                    array_push($dataArr, $name, $type, $attack, $weakness, $resistance);
                    $count = count($dataArr); 

                    for ($i=0; $i < $count; $i++) { 
                        echo "<li>".$textArr[$i] .": ". $dataArr[$i]."</li>";
                    }
                ?>
                </ul>
            </div>
        </div>

        <div id="battle" class="bottom">
            <?php
                
                if (isset($_GET['window'])) {
                    require "Window/".$_GET['window'].".php";
                } else {
                    echo "<div class='inline'>
                        <h2>Active</h2>
                        <a href='PHP/Delete.php?type=active'>reset</a>
                    </div>";
            
                    echo "<div id='active-panel' class='active'>";
                    
                    $data = checkCount($conn);
                    $count = $data['total'];
            
                    if ($count > 0) {
                        $data = getData($conn, 'active');
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "<span class='pokemon-active'><p>".$row['name']."</p></span>";
                        }
                    } else {
                        echo "<h2>No Active pokemon...</h2>";
                    }
            
                    echo "</div>";
                    echo "<a id='start-link' href='index.php?window=Battle'>Start Battle</a>";
                }
                    
            ?>
        </div>
    </div>

    <script>
        const startLink = document.getElementById('start-link');
        const viewTab = document.getElementById('view');

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const viewCheck = urlParams.get('view-check');

        startLink.style.display = 'none';

        <?php 
            $data = checkCount($conn);
            $activeCount = $data['total'];
        ?>
        var activeCount = <?php echo $activeCount?>;

        if (activeCount == 2) {
            startLink.style.display = 'inline';
        }

        if (viewCheck == null) {
            viewTab.style.display = 'none';
        }
    </script>
</body>
</html>