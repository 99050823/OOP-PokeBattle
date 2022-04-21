<!DOCTYPE html>
<html lang="en">
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
                        echo $listElements;
                    ?>
                </ul>

                <form method="post">
                    <input name="add" type="submit" value="Add Pokemon">
                </form>
            </div>

            <div id="view">
                <p>Pokemon View</p>
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