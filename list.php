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
            $servername = "localhost";
            $username = "default";
            $password = "123";
            $dbname = "WEB_SERVER";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = 'SELECT id, name FROM plants';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>
        <li>
            <a href=<?php echo "index.php?id=" . $row['id']?> ><?php echo $row['name']?></a>
        </li>
        <?php 
                }   
            }
            $conn->close();
        ?>
    </ul>
</body>
</html>