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
        <div class="topNav" id="myTopnav">
            <div class="topNavLeft">
                <a id="logo" href="../index.php">
                    <img src="../images/butcher_shop_logo.png" alt="logo">
                </a>
            </div>
            <div class="topNavRight ">
                <a href="../index.php">Home</a>
                <a href="services.php">Services</a>
                <a href="products.php">Products</a>
                <a href="../admin/index.php">Login</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </header>
    <div class="headerLine"></div>

    <div class="wrapper">
        <div class="indexWrapper" id="productBlob">
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
                <?php
                try {
                    $stmt = $db->query('SELECT productID, productTitle, productType, productMeatType, productImage, productDesc, productCont, productPrice, productPriceUnit FROM butcher_shop_products ORDER BY productID');
                    while($row = $stmt->fetch()){
                        echo '<div class=product>';
                        echo '<h2>'.$row['productTitle'].'</h2>';
                        echo '<img src="../images/'.$row['productImage'].'" alt="">';
                        echo '<p>'.$row['productCont'].'</p>';
                        echo '<p id="productPrice">'.$row['productPrice'].' '.$row['productPriceUnit'].'</p>';
                        echo '</div>';
                    }
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>

    <footer>
        <p> Butcher shop<br>
            eeckhout.jonathan.info@gmail.com<br>
            © 2018 Jonathan Eeckhout
        </p>
    </footer>

    <script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topNav") {
            x.className += " responsive";
        } else {
            x.className = "topNav";
        }
    }
    </script>
</body>
</html>
