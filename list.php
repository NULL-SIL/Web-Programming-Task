<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content list</title>
</head>
<body>
    <a href="/create.php">Add object</a>

    <ul>
        <?php
            $plants=simplexml_load_file("./content/content.xml") or die("Error: Cannot read file");
            foreach($plants->plant as $plant){
        ?>
        <li>
            <a href=<?php echo "index.php?id=" . $plant["id"]?> ><?php echo $plant->name?></a>
        </li>
        <?php }?>
    </ul>
</body>
</html>