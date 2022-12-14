<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update plant data</title>
</head>
<body>

<?php 
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

    $target_file = $target_node->img;
?>

<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] . "?id=". $id;?>">
    Name: <input type="text" name="name" value="<?php echo $target_node->name?>">
    Price: <input type="text" name="price" value="<?php echo $target_node->price?>">
    New picture: <input type="file" name="img">
    <input type="submit">
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $uploadOk = 1;

        $name = $_POST['name'];
        if (empty($name)) {
            $uploadOk = 0;
            echo '<script language="javascript">';
            echo 'alert("Name is empty")';
            echo '</script>';
        }

        $price = $_POST['price'];
        if (empty($price)) {
            $uploadOk = 0;
            echo '<script language="javascript">';
            echo 'alert("Price is empty")';
            echo '</script>';
        }

        if (is_uploaded_file($_FILES["img"]["tmp_name"])){
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if  ($check == false) {
                echo '<script language="javascript">';
                echo 'alert("Incorrect file input")';
                echo '</script>';
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                unlink($target_file);

                $target_file =  $target_dir . $target_node['id'] . "." . end((explode(".", basename($_FILES["img"]["name"]))));

                if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    echo '<script language="javascript">';
                    echo 'alert("Error uploading file")';
                    echo '</script>';
                    $uploadOk = 0;
                }
            }
        }

        if ($uploadOk == 1){
            $target_node->name = $name;
            $target_node->price = $price;
            $target_node->img = $target_file;

            $plants["count"] = $plants["count"] + 1;

            $plants->asXml($target_content_file);

            header("Location: index.php?id=" . $id);
        }
    }
?>
    
</body>
</html>