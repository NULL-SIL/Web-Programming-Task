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
        $servername = "localhost";
        $username = "default";
        $password = "123";
        $dbname = "WEB_SERVER";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

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

        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if  ($check == false) {
            echo '<script language="javascript">';
            echo 'alert("Incorrect file input")';
            echo '</script>';
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            $img = end((explode(".", basename($_FILES["img"]["name"]))));
            $sql = "INSERT INTO plants (name, price, img)
            VALUES ('$name', '$price', '$img')";

            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
            } else {
                echo '<script language="javascript">';
                echo 'alert("Error inserting data")';
                echo '</script>';
                echo "Error: " . $sql . "<br>" . $conn->error;
                $conn-close();
                exit();
            }

            $target_file = $target_dir . $last_id . "." . $img;

            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                header("Location: index.php?id=" . $last_id);
            } else {
                echo '<script language="javascript">';
                echo 'alert("Error uploading file")';
                echo '</script>';

                $sql = "DELETE FROM plants WHERE id=$last_id";
                $conn->query($sql);

                $uploadOk = 0;
            }
        }

        $conn->close();
    }
?>
    
</body>
</html>