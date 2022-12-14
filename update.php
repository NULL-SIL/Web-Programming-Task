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

    $servername = "localhost";
    $username = "default";
    $password = "123";
    $dbname = "WEB_SERVER";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, name, price, img FROM plants WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $target_node = $result->fetch_assoc();
    } else {
        echo '<script language="javascript">';
        echo 'alert("There is no object with such id")';
        echo '</script>';
        $conn->close();
        exit();
    }

    $img = $target_node['img'];
    $target_file = $target_dir . $id . "." . $img;
?>

<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] . "?id=". $id;?>">
    Name: <input type="text" name="name" value="<?php echo $target_node['name']?>">
    Price: <input type="text" name="price" value="<?php echo $target_node['price']?>">
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

                $img = end((explode(".", basename($_FILES["img"]["name"]))));
                $target_file =  $target_dir . $id . "." . $img;

                if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                    echo '<script language="javascript">';
                    echo 'alert("Error uploading file")';
                    echo '</script>';
                    $uploadOk = 0;
                }
            }
        }

        if ($uploadOk == 1){
            $sql = "UPDATE plants SET name='$name', price='$price', img='$img' WHERE id=$id";

            if ($conn->query($sql) === TRUE){
                header("Location: index.php?id=" . $id);
            }else {
                echo '<script language="javascript">';
                echo 'alert("Error updating data")';
                echo '</script>';
                $uploadOk = 0;
            }
        }

        $conn->close();
    }
?>
    
</body>
</html>