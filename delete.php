<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete plant</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] . '?id='. $_GET['id'];?>">
        Delete plant with id = '<?php echo$_GET['id']?>'?
        <input type="submit">
    </form>
    <form method="post" enctype="multipart/form-data" action="<?php echo 'index.php?id=' . $_GET['id'];?>">
        <input type="submit" value="Back">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_GET["id"];
            $target_dir = "content/images/";
            $target_content_file = "./content/content.xml";

            $plants = simplexml_load_file($target_content_file) or die("Error: Cannot read file");

            foreach($plants->plant as $plant){
                if ($plant["id"] == $id){
                    $target_node = $plant;
                    break;
                }
            }

            if(!isset($target_node)){
                echo '<script language="javascript">';
                echo 'alert("There is no object with such id")';
                echo '</script>';
                exit();
            }

            unlink($target_node->img);

            unset($target_node[0][0]);

            $plants['count'] = $plants['count'] - 1;

            $plants->asXml($target_content_file);

            header("Location: index.php?id=" . $id);
        }
        
    ?>

</body>


</html>