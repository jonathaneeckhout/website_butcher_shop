<?php require('../includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Butcher shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title></title>
</head>
<body>
    <header>
        <div class="topNav">
            <div class="topNavLeft">
                <a href="../index.php">
                    <img src="../images/butcher_shop_logo.png" alt="logo">
                </a>
            </div>
            <div class="topNavRight">
                <a href="#services">Services</a>
                <a href="products.php">Products</a>
                <a href="#specials">Specials</a>
                <a href="../admin/index.php">Login</a>
            </div>
        </div>
    </header>
    <div class="headerLine"></div>

    <div class="wrapper">
        <div class="indexWrapper">
            <div class="productSelection">
                <div class="searchContainer">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="selection">
                    <h2>Filter products</h2>
                    <form>
                        <input type="checkbox" name="cow" value="cowMeat"> Cow meat<br>
                        <input type="checkbox" name="chicken" value="chickenMeat"> Chicken meat<br>
                        <input type="checkbox" name="pork" value="porkMeat"> Pork meat<br>
                    </form>
                </div>
            </div>
            <div class="products">
                <div class="product">
                    <h2>Barbecue Sausage </h2>
                    <img src="../images/barbecue-bbq-cooking-929137.resized.jpg" alt="bbq Sausage">
                    <p>Delicious barbecue sausages. Perfect for your summer barbecue. Straight from our local farmer</p>
                    <p id="productPrice">11 euro/kg</p>
                </div>
                <div class="product">
                    <h2>Barbecue Sausage </h2>
                    <img src="../images/barbecue-bbq-cooking-929137.resized.jpg" alt="bbq Sausage">
                    <p></p>

                </div>
                <div class="product">
                    <h2>Barbecue Sausage </h2>
                    <img src="../images/barbecue-bbq-cooking-929137.resized.jpg" alt="bbq Sausage">
                    <p></p>

                </div>
                <div class="product">
                    <h2>Barbecue Sausage </h2>
                    <img src="../images/barbecue-bbq-cooking-929137.resized.jpg" alt="bbq Sausage">
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p> Butcher shop<br>
            eeckhout.jonathan.info@gmail.com<br>
            © 2018 Jonathan Eeckhout
        </p>
    </footer>

    <!-- <script type = "text/javascript" src = "js/get_posts_index.js" ></script> -->
</body>
</html>
