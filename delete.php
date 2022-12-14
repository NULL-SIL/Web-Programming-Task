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
        
            $servername = "localhost";
            $username = "default";
            $password = "123";
            $dbname = "WEB_SERVER";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT img FROM plants WHERE id=$id";
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

            if(!unlink($target_dir . $id . '.' . $target_node['img'])){
                echo '<script language="javascript">';
                echo 'alert("Error deleting file")';
                echo '</script>';
                $conn->close();
                exit();
            }

            $sql = "DELETE FROM plants WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php?id=" . $id);
            } else {
                echo '<script language="javascript">';
                echo 'alert("Error deleting record")';
                echo '</script>';
            }

            $conn->close();
        }
        
    ?>

</body>


</html>