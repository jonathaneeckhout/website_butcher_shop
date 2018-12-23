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
                    <input id="searchValue" type="text" placeholder="Search.." name="search">
                    <button onclick="searchProduct()"><i class="fa fa-search"></i></button>
                </div>
                <div class="selection">
                    <h2>Filter products</h2>
                    <input class="filterField" type="checkbox" name="cow" value="beef"> Cow meat<br>
                    <input class="filterField" type="checkbox" name="chicken" value="chicken"> Chicken meat<br>
                    <input class="filterField" type="checkbox" name="pork" value="pork"> Pork meat<br>
                    <button onclick="filterProduct()">Apply filter</button>
                </div>
            </div>
            <div class="products" id='myProducts'>
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
    <script src="../js/fetch_products.js"></script>
</body>
</html>
