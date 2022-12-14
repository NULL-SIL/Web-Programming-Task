<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Document</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="block-1">
        <div class="main-image-container image-crop">
            <img class="main-image" src="img/pexels-cottonbro-4503751 1.png" alt="Plant" width="600" height="740">
        </div>
        <header class="right-half">
            <ul class="header-buttons">
                <li class="header-button header-icons">
                    <img src="img/search-icon.svg" alt="">
                    <img src="img/shopping-cart-icon.svg" alt="">
                </li>
                <li class="header-button sign-up-button">Sign up</li>
                <li class="header-button sign-in-button">Sign in</li>
            </ul>
            <div class="header-title">
                <h1>Kembang <br>Flower Mantap</h1>
                <p class="regular-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
            </div>
        </header>
    </div>

    <main>

        <ul class="features">
            <li class="feature">
                <div class="feature-header">
                    <img src="img/Icon-1.svg" alt="">
                    <p class="feature-title">Fast <br>Delivery</p>
                </div>
                <p class="feature-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard </p>
            </li>
            <li class="feature">
                <div class="feature-header">
                    <img src="img/Icon-2.svg" alt="">
                    <p class="feature-title">Great Customer Service</p>
                </div>
                <p class="feature-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard </p>
            </li>
            <li class="feature">
                <div class="feature-header">
                    <img src="img/Icon-3.svg" alt="">
                    <p class="feature-title">Original <br>Plants</p>
                </div>
                <p class="feature-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard </p>
            </li>
            <li class="feature">
                <div class="feature-header">
                    <img src="img/Icon-4.svg" alt="">
                    <p class="feature-title">Affordable <br>Price</p>
                </div>
                <p class="feature-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard </p>
            </li>
        </ul>

        <div class="featured-plants">
            <h2>Featured plants</h2>
            <a href="/list.php">Objects list</a>
            <a href=<?php echo "/update.php?id=" . $_GET["id"]?>><?php echo "update id = " . $_GET["id"]?></a>
            <a href=<?php echo "/delete.php?id=" . $_GET["id"]?>><?php echo "delete id = " . $_GET["id"]?></a>
            <ul class="plants">
                <?php
                    $servername = "localhost";
                    $username = "default";
                    $password = "123";
                    $dbname = "WEB_SERVER";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = 'SELECT id, name, price, img FROM plants';
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                ?>
                <li class="plant">
                    <img src=<?php echo 'content/images/' . $row['id'] . '.' . $row['img']?> alt="" width="217" height="217">
                    <p class="featured-plant-name"><?php echo $row['name']?></p>
                    <p class="featured-plant-price"><?php echo $row['price']?></p>
                </li>
                <?php 
                        }
                    }
                    $conn->close(); 
                ?>
            </ul>
        </div>

        <div class="about">
            <div class="information">
                <div>
                    <h3>Buy more plants, it helps you to be relaxed</h3>
                    <p class="regular-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi gravida gravida aliquam. Pellentesque et lobortis nisl. Sed et mauris justo. Nulla eu enim non mauris maximus dignissim. Maecenas vitae eros sapien. Quisque pellentesque tempus dignissim.</p>
                </div>
                <img class="under-text-image" src="img/liana-mikah-8tJxjQWTyNA-unsplash 1.png" alt="">
            </div>

            <div class="image-crop right-side-image-1">
                <img class="right-side-image-1" src="img/jason-leung-r5pPYI6lEpA-unsplash 1.png"  alt="" width="500">
            </div>
        </div>

        <div class="buy-block">
            <div class="buy-block-header">
                <h4>Get your favourites plant on our shop now</h4>
                <div class="shop-button">
                    <p>Visit shop</p>
                </div>
            </div>
            <img class="right-side-image-2" src="img/Big-Plant.png" alt="">
        </div>

    </main>

    <footer>
        <div class="footer-column">
            <h5>plantku</h5>
            <p class="footer-block-title">Plantku House</p>
            <p class="footer-block-text">Jl. Laksda Adisucipto No.51, Demangan, Kec. Depok, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55282</p>
        </div>
        <div class="footer-column">
            <p class="footer-block-title">Perusahaan</p>
            <p class="footer-block-subtitle">Tentang Kami</p>
            <p class="footer-block-subtitle">Hubungi Kami</p>
        </div>
        <div class="footer-column">
            <p class="footer-block-title">Produk</p>
            <p class="footer-block-subtitle">Tanaman</p>
            <p class="footer-block-subtitle">Tanaman Lain</p>
        </div>
        <div class="footer-column">
            <p class="footer-block-title">Berlangganan Email Kami</p>
            <input type="email" placeholder="Masukan Alamat Email" class="email-input">
            <div class="submit-button">Submit</div>
        </div>
    </footer>
</body>
</html>