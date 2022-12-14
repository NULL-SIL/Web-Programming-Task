<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new plant</title>
</head>
<body>

<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Name: <input type="text" name="name">
    Price: <input type="text" name="price">
    Picture: <input type="file" name="img">
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

        $target_dir = "content/images/";
        $target_content_file = "./content/content.xml";

        $plants = simplexml_load_file($target_content_file) or die("Error: Cannot read file");

        $target_file = $target_dir . $plants["count"] . "." .end((explode(".", basename($_FILES["img"]["name"]))));

        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if  ($check == false) {
            echo '<script language="javascript">';
            echo 'alert("Incorrect file input")';
            echo '</script>';
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["img"]["name"])). " has been uploaded.";
            } else {
                echo '<script language="javascript">';
                echo 'alert("Error uploading file")';
                echo '</script>';
                $uploadOk = 0;
            }
        }

        if ($uploadOk == 1){
            $new_plant = $plants->addChild("plant", "");
            $new_plant->addAttribute("id", $plants["count"]);
            $new_plant->addChild("name", $name);
            $new_plant->addChild("price", $price);
            $new_plant->addChild("img", $target_file);

            $plants["count"] = $plants["count"] + 1;

            $plants->asXml($target_content_file);

            header("Location: index.php?id=" . ($plants["count"]-1));
        }
    }
?>
    
</body>
</html>